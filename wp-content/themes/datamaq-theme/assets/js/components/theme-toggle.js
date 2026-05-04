/**
 * DataMaq Theme Toggle (Dark/Light Mode)
 * -------------------------------------
 * Manages global theme state and persistence.
 */

(function() {
    'use strict';

    const ThemeManager = {
        init() {
            const savedTheme = localStorage.getItem('dm-theme') || 'dark';
            this.setTheme(savedTheme);
            
            // Check for system preference if no saved theme
            if (!localStorage.getItem('dm-theme')) {
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                this.setTheme(systemDark ? 'dark' : 'light');
            }

            this.createToggle();
        },

        setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('dm-theme', theme);
            this.updateToggleUI(theme);
        },

        toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            this.setTheme(next);
        },

        createToggle() {
            // Floating toggle button
            const btn = document.createElement('button');
            btn.id = 'dm-theme-toggle';
            btn.className = 'c-theme-toggle';
            btn.setAttribute('aria-label', 'Cambiar tema');
            btn.innerHTML = `
                <i class="bi bi-moon-stars-fill dark-icon"></i>
                <i class="bi bi-sun-fill light-icon"></i>
            `;
            
            btn.addEventListener('click', () => this.toggleTheme());
            document.body.appendChild(btn);
            
            this.addStyles();
        },

        updateToggleUI(theme) {
            const btn = document.getElementById('dm-theme-toggle');
            if (btn) {
                btn.classList.toggle('is-light', theme === 'light');
            }
        },

        addStyles() {
            if (document.getElementById('dm-theme-toggle-styles')) return;
            
            const style = document.createElement('style');
            style.id = 'dm-theme-toggle-styles';
            style.textContent = `
                .c-theme-toggle {
                    position: fixed;
                    bottom: 2rem;
                    left: 2rem;
                    width: 3.5rem;
                    height: 3.5rem;
                    border-radius: 50%;
                    background: var(--dm-bg-surface);
                    color: var(--dm-color-brand-primary);
                    border: 1px solid var(--dm-border-color);
                    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                    cursor: pointer;
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.5rem;
                    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    padding: 0;
                }

                .c-theme-toggle:hover {
                    transform: scale(1.1) rotate(10deg);
                    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
                }

                .c-theme-toggle .light-icon { display: none; }
                .c-theme-toggle .dark-icon { display: block; }

                .c-theme-toggle.is-light .light-icon { display: block; }
                .c-theme-toggle.is-light .dark-icon { display: none; }
                
                .c-theme-toggle.is-light {
                    color: #ffb606;
                    background: #ffffff;
                }

                @media (max-width: 768px) {
                    .c-theme-toggle {
                        bottom: 6.5rem; /* Above the dock */
                        left: 1.5rem;
                        width: 3rem;
                        height: 3rem;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    };

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
    } else {
        ThemeManager.init();
    }
})();
