/**
 * Scroll Reveal Component
 * Replicates the "Premium Feel" of reveal animations.
 */
window.DM.Componentizer.register('ScrollReveal', class extends window.DM.BaseComponent {
    constructor(el) {
        super(el);
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.el.classList.add('is-revealed');
                    this.observer.unobserve(this.el);
                }
            });
        }, { threshold: 0.1 });
        
        this.observer.observe(this.el);
    }
});
