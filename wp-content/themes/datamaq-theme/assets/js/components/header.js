/**
 * Header Component
 * Handles sticky transitions.
 */
window.DM.Componentizer.register('Header', class extends window.DM.BaseComponent {
    constructor(el) {
        super(el);
        this.ticking = false;
        window.addEventListener("scroll", () => this.onScroll(), { passive: true });
    }

    onScroll() {
        if (!this.ticking) {
            window.requestAnimationFrame(() => {
                const scrollPos = window.scrollY;
                this.el.classList.toggle("is-scrolled", scrollPos > 60);
                this.ticking = false;
            });
            this.ticking = true;
        }
    }
});
