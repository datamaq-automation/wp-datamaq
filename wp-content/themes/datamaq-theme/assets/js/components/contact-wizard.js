/**
 * Contact Wizard Component
 */
window.DM.Componentizer.register('ContactWizard', class extends window.DM.BaseComponent {
    constructor(el) {
        super(el);
        this.currentStep = 1;
        this.totalSteps = 3;
        
        this.btnNext = document.getElementById('btn-next');
        this.btnBack = document.getElementById('btn-back');
        this.btnSubmit = document.getElementById('btn-submit');
        this.progressBar = document.getElementById('step-progress-bar');
        this.indicator = document.getElementById('step-indicator');
        this.dots = document.querySelectorAll('.step-dot');

        this.init();
    }

    init() {
        if (this.btnNext) this.btnNext.onclick = () => this.next();
        if (this.btnBack) this.btnBack.onclick = () => this.prev();
        
        this.el.onsubmit = (e) => this.handleSubmit(e);

        this.el.querySelectorAll('input[type="radio"]').forEach(rad => {
            rad.onchange = () => this.updateRadios();
        });

        this.updateUI();
    }

    updateUI() {
        this.el.querySelectorAll('.dm-form-step').forEach(s => s.classList.add('tw:hidden'));
        const activeStepEl = document.getElementById(`step-${this.currentStep}`);
        if (activeStepEl) activeStepEl.classList.remove('tw:hidden');
        
        if (this.progressBar) this.progressBar.style.width = (this.currentStep / this.totalSteps * 100) + '%';
        if (this.indicator) this.indicator.textContent = `Paso ${this.currentStep} de ${this.totalSteps}`;
        
        this.dots.forEach((dot, idx) => {
            if (idx < this.currentStep) dot.classList.add('tw:bg-[#ff6a00]', 'tw:scale-125');
            else dot.classList.remove('tw:bg-[#ff6a00]', 'tw:scale-125');
        });
        
        if (this.btnBack) this.btnBack.classList.toggle('tw:hidden', this.currentStep === 1);
        if (this.btnNext) this.btnNext.classList.toggle('tw:hidden', this.currentStep === this.totalSteps);
        if (this.btnSubmit) this.btnSubmit.classList.toggle('tw:hidden', this.currentStep !== this.totalSteps);
    }

    next() {
        const activeStep = document.getElementById(`step-${this.currentStep}`);
        const inputs = activeStep.querySelectorAll('input[required], textarea[required]');
        let valid = true;
        inputs.forEach(i => {
            if(!i.value) { i.classList.add('tw:border-red-500/50'); valid = false; }
            else { i.classList.remove('tw:border-red-500/50'); }
        });
        if (valid && this.currentStep < this.totalSteps) {
            this.currentStep++;
            this.updateUI();
            window.scrollTo({ top: this.el.offsetTop - 100, behavior: 'smooth' });
        }
    }

    prev() {
        if (this.currentStep > 1) {
            this.currentStep--;
            this.updateUI();
        }
    }

    updateRadios() {
        this.el.querySelectorAll('.opt-box').forEach(box => box.classList.remove('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40'));
        const checked = this.el.querySelector('input[type="radio"]:checked');
        if (checked) checked.nextElementSibling.classList.add('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40');
    }

    handleSubmit(e) {
        const channelInput = this.el.querySelector('input[name="dm_channel"]:checked');
        const channel = channelInput ? channelInput.value : 'email';
        
        if (channel === 'whatsapp') {
            e.preventDefault();
            const name = this.el.dm_name.value;
            const company = this.el.dm_company.value;
            const msg = this.el.dm_message.value;
            const text = `Hola, soy ${name} de ${company}. ${msg}`;
            window.open(`https://wa.me/5491156297160?text=${encodeURIComponent(text)}`, '_blank');
            window.location.href = window.datamaq_vars?.thanks_url || '/gracias';
        }
    }
});
