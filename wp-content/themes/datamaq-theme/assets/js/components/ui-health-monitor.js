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
                'a',
                '.course-section__title',
                '.course-section__description',
                '.section-count-items'
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
            const bgColor = this.parseRGB(this.getRecursiveBgColor(el));
            const fgColor = this.parseRGB(style.color);

            if (!bgColor || !fgColor) return;

            const ratio = this.getContrastRatio(bgColor, fgColor);

            if (ratio < this.config.threshold) {
                // Check if it's a known interactive element that might have temporary low contrast
                if (el.closest('.lp-button') || el.offsetParent === null) return;
                
                this.reportError(`Low Contrast Ratio (${ratio.toFixed(2)}:1)`, el);
            }
        },

        parseRGB(colorStr) {
            const rgb = colorStr.match(/\d+/g);
            if (!rgb) return null;
            return { r: parseInt(rgb[0]), g: parseInt(rgb[1]), b: parseInt(rgb[2]) };
        },

        getLuminance({ r, g, b }) {
            const a = [r, g, b].map(v => {
                v /= 255;
                return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
            });
            return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722;
        },

        getContrastRatio(rgb1, rgb2) {
            const lum1 = this.getLuminance(rgb1);
            const lum2 = this.getLuminance(rgb2);
            const brightest = Math.max(lum1, lum2);
            const darkest = Math.min(lum1, lum2);
            return (brightest + 0.05) / (darkest + 0.05);
        },

        getRecursiveBgColor(el) {
            let bg = window.getComputedStyle(el).backgroundColor;
            if (bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent' && !bg.includes('rgba(255, 255, 255, 0)')) return bg;
            if (el.parentElement) return this.getRecursiveBgColor(el.parentElement);
            return 'rgb(12, 9, 47)'; // DataMaq Dark Theme Base Background
        },

        reportError(message, element) {
            // Only log if it's not a false positive or hidden element
            if (element.offsetWidth === 0 && element.offsetHeight === 0) return;

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
