/**
 * DataMaq Chatbot - Vanilla JS Engine
 */

// --- Interceptor de API (Ejecución Inmediata) ---
(function() {
    const originalFetch = window.fetch;
    window.fetch = function() {
        let [resource, config] = arguments;
        if (typeof resource === 'string' && resource.includes('api.datamaq.com.ar/v1/health')) {
            console.log('🔄 Intercepted external health check. Redirecting to local proxy...');
            resource = '/wp-json/datamaq/v1/observability/health';
        }
        return originalFetch.apply(this, [resource, config]);
    };
})();

document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 DataMaq Chat initialized on:', window.location.href);

    const chatContainer = document.getElementById('dm-chat-container');

    // --- Observability Tooling ---
    const logToServer = async (level, message, context = {}) => {
        try {
            await fetch('/wp-json/datamaq/v1/observability/log', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ level, message, context })
            });
        } catch (e) { /* Fail silently to avoid infinite loops */ }
    };

    // Capturar errores globales del navegador y enviarlos al servidor
    window.addEventListener('error', (event) => {
        logToServer('error', event.message, {
            filename: event.filename,
            lineno: event.lineno,
            url: window.location.href
        });
    });

    // --- Chat Logic ---
    chatToggle.addEventListener('click', () => {
        chatContainer.classList.toggle('tw:hidden');
        chatInput.focus();
    });

    // Handle Sending Messages
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;

        // Render User Message
        appendMessage('user', message);
        chatInput.value = '';

        try {
            console.log('📤 Sending message to: /wp-json/datamaq/v1/chat');
            const response = await fetch('/wp-json/datamaq/v1/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 'driver': 'web', 'message': message })
            });

            const data = await response.json();
            
            // BotMan devuelve un array de mensajes
            if (data.messages) {
                data.messages.forEach(msg => appendMessage('bot', msg.text));
            } else if (data.text) {
                appendMessage('bot', data.text);
            }
        } catch (error) {
            console.error('DataMaq Chat Error:', error);
            appendMessage('bot', 'Lo siento, hubo un error de conexión.');
        }
    });

    function appendMessage(sender, text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `tw:mb-3 tw:p-3 tw:rounded-lg tw:max-w-[80%] ${
            sender === 'user' 
            ? 'tw:bg-dm-primary tw:text-white tw:ml-auto tw:rounded-br-none' 
            : 'tw:bg-dm-surface-200 tw:text-dm-text-900 tw:mr-auto tw:rounded-bl-none'
        }`;
        msgDiv.textContent = text;
        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});
