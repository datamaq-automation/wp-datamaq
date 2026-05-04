/**
 * DataMaq UI Health Monitor
 * ------------------------
 * Part of the Phase 3 (Observability) Plan.
 * This component monitors the interface for accessibility failures,
 * specifically contrast issues in critical learning paths.
 */

(function() {
    'use strict';

    const UIHealthMonitor = {
        config: {
            threshold: 4.5, // WCAG AA target
            checkDelay: 2000,
            criticalSelectors: [
                '.lesson-title',
                '.course-item-title',
                '.lp-archive-courses-title',
                'a'
            ]
        },

        init() {
            if (window.requestIdleCallback) {
                window.requestIdleCallback(() => this.runAudit());
            } else {
                setTimeout(() => this.runAudit(), this.config.checkDelay);
            }
            
            // Re-run when the popup opens (LearnPress specific)
            this.observePopup();
        },

        observePopup() {
            const observer = new MutationObserver((mutations) => {
                if (document.body.classList.contains('course-item-popup')) {
                    this.runAudit();
                }
            });

            observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
        },

        runAudit() {
            console.log('🔍 [UI Monitor] Running accessibility health check...');
            
            this.config.criticalSelectors.forEach(selector => {
                const elements = document.querySelectorAll(selector);
                elements.forEach(el => this.checkContrast(el));
            });
        },

        checkContrast(el) {
            const style = window.getComputedStyle(el);
            const bgColor = this.getRecursiveBgColor(el);
            const fgColor = style.color;

            // Simple check: if both are effectively white
            if (this.isWhiteish(bgColor) && this.isWhiteish(fgColor)) {
                this.reportError('Critical Contrast Failure', el);
            }
        },

        isWhiteish(colorStr) {
            // Very simple heuristic for "white on white" detection
            const rgb = colorStr.match(/\d+/g);
            if (!rgb) return false;
            return rgb[0] > 220 && rgb[1] > 220 && rgb[2] > 220;
        },

        getRecursiveBgColor(el) {
            let bg = window.getComputedStyle(el).backgroundColor;
            if (bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent') return bg;
            if (el.parentElement) return this.getRecursiveBgColor(el.parentElement);
            return 'rgb(255, 255, 255)'; // Default
        },

        reportError(message, element) {
            console.error(`🚨 [UI Monitor] ${message}:`, element);
            
            // In a real production environment, we would send this to Sentry or LogRocket
            window.dm_ui_health = window.dm_ui_health || [];
            window.dm_ui_health.push({
                type: 'A11Y_FAILURE',
                message,
                element: element.className,
                timestamp: new Date().toISOString()
            });
            
            // Visual indicator for developers in dev environments
            if (location.hostname === 'localhost' || location.search.includes('debug')) {
                element.style.outline = '4px solid red';
                element.style.outlineOffset = '4px';
                element.title = 'CONTRASte CRÍTICO DETECTADO';
            }
        }
    };

    // Auto-init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => UIHealthMonitor.init());
    } else {
        UIHealthMonitor.init();
    }
})();
