/**
 * DataMaq Unified Gateway - Professional Architecture Edition
 * 
 * Basado en Arquitectura Hexagonal, SOLID y DDD.
 */

// --- [ DOMAIN & INTERFACES ] ---

class LogLevel {
    static INFO = 'info';
    static WARN = 'warn';
    static ERROR = 'error';
    static DEBUG = 'debug';
}

/**
 * Puerto: Interface para Proveedores de Chat
 */
class ChatProvider {
    initialize() { throw new Error("Method not implemented"); }
    open() { throw new Error("Method not implemented"); }
    onReady(callback) { throw new Error("Method not implemented"); }
}

// --- [ INFRASTRUCTURE - OBSERVABILITY ] ---

class Logger {
    static log(level, message, context = {}) {
        const colors = {
            [LogLevel.INFO]: '#00A8E8',
            [LogLevel.WARN]: '#FFCC00',
            [LogLevel.ERROR]: '#FF3B30',
            [LogLevel.DEBUG]: '#FF6A00'
        };
        const emoji = {
            [LogLevel.INFO]: 'ℹ️',
            [LogLevel.WARN]: '⚠️',
            [LogLevel.ERROR]: '❌',
            [LogLevel.DEBUG]: '🚀'
        };

        console.log(
            `%c${emoji[level]} [DataMaq] ${message}`,
            `color: ${colors[level]}; font-weight: bold;`,
            context
        );
    }
}

// --- [ INFRASTRUCTURE - CHAT ADAPTER ] ---

class ChatwootAdapter extends ChatProvider {
    constructor(config) {
        super();
        this.baseUrl = config.baseUrl;
        this.token = config.token;
        this.isLoaded = false;
        this.pendingOpen = false;
    }

    initialize() {
        const d = document;
        const t = "script";
        const g = d.createElement(t);
        const s = d.getElementsByTagName(t)[0];

        g.src = `${this.baseUrl}/packs/js/sdk.js`;
        g.async = true;
        s.parentNode.insertBefore(g, s);

        g.onload = () => {
            window.chatwootSDK.run({
                websiteToken: this.token,
                baseUrl: this.baseUrl
            });
        };

        window.addEventListener('chatwoot:ready', () => {
            this.isLoaded = true;
            if (this.pendingOpen) {
                this.open();
                this.pendingOpen = false;
            }
        });
    }

    open() {
        if (window.$chatwoot) {
            window.$chatwoot.toggle();
            return true;
        }
        Logger.log(LogLevel.WARN, 'SDK not ready yet. Queuing open request.');
        this.pendingOpen = true;
        return false;
    }
}

// --- [ INFRASTRUCTURE - NETWORK ] ---

class NetworkInterceptor {
    constructor(chatService, appSecret) {
        this.chatService = chatService;
        this.appSecret = appSecret;
        this.originalFetch = window.fetch;
    }

    activate() {
        window.fetch = (...args) => this.intercept(...args);
        
        // Monitor de errores de carga de recursos
        window.addEventListener('error', (e) => {
            if ((e.target.tagName === 'SCRIPT' || e.target.tagName === 'IFRAME') && e.target.src?.includes('chatwoot')) {
                Logger.log(LogLevel.ERROR, 'Chatwoot Resource Blocked/Failed', { url: e.target.src });
            }
        }, true);
    }

    async intercept(resource, config) {
        let url = typeof resource === 'string' ? resource : resource.url;

        // Intercepción de Leads
        if (url.includes('/datamaq/v1/lead')) {
            return this.handleLeadCapture(url, config);
        }

        return this.originalFetch.apply(window, [url, config]);
    }

    async handleLeadCapture(url, config) {
        const traceId = `cw-${Math.random().toString(36).substr(2, 9)}`;
        const startTime = performance.now();
        

        const tracker = new MarketingTracker();
        const marketingData = tracker.getStoredData();

        const targetUrl = '/index.php?rest_route=/datamaq/v1/lead';
        const enhancedConfig = {
            ...config,
            // Inyectar datos de marketing en el body si es un JSON
            body: this.enhanceBody(config.body, marketingData),
            headers: {
                ...(config?.headers || {}),
                'X-DataMaq-Trace-ID': traceId,
                'X-DataMaq-Secret': this.appSecret,
                'X-DataMaq-Source': 'Unified-Gateway'
            }
        };

        try {
            const response = await this.originalFetch.apply(window, [targetUrl, enhancedConfig]);
            const duration = (performance.now() - startTime).toFixed(2);

            if (!response.ok) {
                Logger.log(LogLevel.ERROR, `API Error [${response.status}]`, { traceId, status: response.status });
            }

            return response;
        } catch (err) {
            Logger.log(LogLevel.ERROR, 'Lead Sync Network Failure', { error: err.message });
            throw err;
        }
    }

    enhanceBody(body, marketingData) {
        if (!body) return body;
        try {
            const data = JSON.parse(body);
            return JSON.stringify({
                ...data,
                marketing: marketingData
            });
        } catch (e) {
            return body; // Si no es JSON, devolver original
        }
    }
}

// --- [ INFRASTRUCTURE - UI/DOM ] ---

class DOMSentinel {
    constructor(chatService) {
        this.chatService = chatService;
    }

    watch() {
        this.hijackInteractions();
        
        window.addEventListener('load', () => {
            this.cleanup();
            const observer = new MutationObserver(() => this.cleanup());
            observer.observe(document.body, { childList: true, subtree: true });
        });
    }

    hijackInteractions() {
        // Interceptar window.open
        const originalOpen = window.open;
        window.open = (url, ...args) => {
            if (typeof url === 'string' && (url.includes('wa.me') || url.includes('whatsapp.com'))) {
                Logger.log(LogLevel.INFO, 'WhatsApp redirect diverted to Chatwoot.');
                this.chatService.open();
                return null;
            }
            return originalOpen.apply(window, [url, ...args]);
        };

        // Interceptar Clicks
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && (link.href.includes('wa.me') || link.href.includes('whatsapp.com') || link.getAttribute('href') === '#chat')) {
                Logger.log(LogLevel.INFO, 'Interaction intercepted. Triggering Chat.');
                e.preventDefault();
                e.stopPropagation();
                this.chatService.open();
            }
        }, true);
    }

    cleanup() {
        const legacySelectors = '.c-whatsapp-fab, .c-contact-page-footer__whatsapp, .c-home-footer__whatsapp';
        document.querySelectorAll(legacySelectors).forEach(el => {
            if (!el.dataset.cleaned) {
                el.dataset.cleaned = "true";
                el.remove();
            }
        });

        const dockEmergency = document.querySelector('.c-home-dock__link--emergency');
        if (dockEmergency && !dockEmergency.dataset.chatHijacked) {
            dockEmergency.dataset.chatHijacked = "true";
            dockEmergency.innerHTML = '<i class="bi bi-chat-dots-fill" aria-hidden="true" style="font-size: 1.3rem; margin-bottom: 2px;"></i><span>Asistente</span>';
            dockEmergency.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.chatService.open();
            }, true);
        }
    }
}

// --- [ INFRASTRUCTURE - MARKETING ] ---

class MarketingTracker {
    constructor() {
        this.storageKey = 'dm_marketing_data';
    }

    capture() {
        const urlParams = new URLSearchParams(window.location.search);
        const utms = {};
        const utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
        
        let hasUtms = false;
        utmKeys.forEach(key => {
            if (urlParams.has(key)) {
                utms[key] = urlParams.get(key);
                hasUtms = true;
            }
        });

        const currentData = this.getStoredData();
        
        // Si hay nuevos UTMs, o si no hay datos previos, capturamos
        if (hasUtms || !currentData.landing_page) {
            const data = {
                ...utms,
                referrer: document.referrer || currentData.referrer || 'direct',
                landing_page: window.location.href,
                timestamp: new Date().toISOString()
            };
            sessionStorage.setItem(this.storageKey, JSON.stringify(data));
            if (hasUtms) Logger.log(LogLevel.DEBUG, 'Marketing UTMs Captured', utms);
        }
    }

    getStoredData() {
        try {
            const stored = sessionStorage.getItem(this.storageKey);
            return stored ? JSON.parse(stored) : {};
        } catch (e) {
            return {};
        }
    }
}

// --- [ APPLICATION ORCHESTRATOR ] ---

class DataMaqGateway {
    static async start() {
        // 1. Intentar obtener configuración inyectada o vía API
        let config = window.DataMaqConfig || null;

        if (!config) {
            try {
                const response = await fetch('/index.php?rest_route=/datamaq/v1/config');
                if (response.ok) {
                    const data = await response.json();
                    config = {
                        baseUrl: data.baseUrl,
                        token: data.websiteToken,
                        appSecret: data.appSecret
                    };
                }
            } catch (e) {
                // Silencio: Usar fallback
            }
        }

        // 2. Fallback de emergencia (Hardcoded)
        const finalConfig = config || {
            baseUrl: "https://chatwoot.datamaq.com.ar",
            token: "EaFpQ65unLmqzYshTRLS8R2E",
            appSecret: "" // Sin secreto por defecto en fallback
        };

        const chatService = new ChatwootAdapter(finalConfig);
        const network = new NetworkInterceptor(chatService, finalConfig.appSecret);
        const ui = new DOMSentinel(chatService);
        const tracker = new MarketingTracker();

        tracker.capture(); // Capturar atribución actual
        chatService.initialize();
        network.activate();
        ui.watch();
    }
}

// Initialize
DataMaqGateway.start();
