/**
 * Mobile Menu Component
 */
window.DM.Componentizer.register('MobileMenu', class extends window.DM.BaseComponent {
    constructor(el) {
        super(el);
        this.toggle = document.getElementById("mobile-menu-toggle");
        this.close = document.getElementById("mobile-menu-close");
        this.overlay = document.getElementById("offcanvas-overlay");
        
        if (this.toggle) this.toggle.onclick = () => this.show();
        if (this.close) this.close.onclick = () => this.hide();
        if (this.overlay) this.overlay.onclick = () => this.hide();
        
        this.el.querySelectorAll('a').forEach(a => {
            a.onclick = () => this.hide();
        });
    }

    show() {
        this.el.classList.add("is-active");
        document.documentElement.classList.add("dmq-offcanvas-open");
        document.body.classList.add("dmq-offcanvas-open");
    }

    hide() {
        this.el.classList.remove("is-active");
        document.documentElement.classList.remove("dmq-offcanvas-open");
        document.body.classList.remove("dmq-offcanvas-open");
    }
});
