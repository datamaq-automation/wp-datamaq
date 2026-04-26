/**
 * DataMaq UI Componentizer
 * Lightweight infrastructure for decoupled JS components.
 */
class DMComponentizer {
    constructor() {
        this.components = {};
    }

    register(name, componentClass) {
        this.components[name] = componentClass;
    }

    init() {
        document.querySelectorAll('[data-dm-component]').forEach(el => {
            const name = el.getAttribute('data-dm-component');
            if (this.components[name]) {
                new this.components[name](el);
                console.log(`[DM] Component initialized: ${name}`);
            }
        });
    }
}

// Global instance
window.DM = window.DM || {};
window.DM.Componentizer = new DMComponentizer();

// Base Component Class
window.DM.BaseComponent = class {
    constructor(element) {
        this.el = element;
    }
};

document.addEventListener('DOMContentLoaded', () => {
    window.DM.Componentizer.init();
});
