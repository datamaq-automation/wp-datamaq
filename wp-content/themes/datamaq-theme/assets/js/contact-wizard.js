/**
 * DataMaq Contact Wizard JS
 * Handles multi-step form navigation, AJAX submission, and conditional validation.
 */
document.addEventListener('DOMContentLoaded', () => {
    let currentStep = 1;
    const totalSteps = 3;
    
    const contactForm = document.querySelector('.c-contact form');
    if (!contactForm) return;

    const btnNext = document.getElementById('btn-next');
    const btnBack = document.getElementById('btn-back');
    const btnSubmit = document.getElementById('btn-submit');
    const progressBar = document.querySelector('.c-contact__progress-fill');
    const indicator = document.querySelector('.c-contact__progress-text');
    const steps = document.querySelectorAll('.c-contact__stepper-item');

    function updateUI() {
        document.querySelectorAll('.c-contact__step-panel').forEach(s => s.classList.add('tw:hidden'));
        const activePanel = document.getElementById(`step-panel-${currentStep}`);
        if (activePanel) activePanel.classList.remove('tw:hidden');
        
        steps.forEach((step, idx) => {
            const stepNum = idx + 1;
            if (stepNum === currentStep) step.classList.add('is-active');
            else step.classList.remove('is-active');
        });

        if (progressBar) progressBar.style.width = (currentStep / totalSteps * 100) + '%';
        if (indicator) indicator.textContent = `Paso ${currentStep} de ${totalSteps}`;
        
        if (btnNext) btnNext.classList.toggle('tw:hidden', currentStep === totalSteps);
        if (btnSubmit) btnSubmit.classList.toggle('tw:hidden', currentStep !== totalSteps);
    }

    // Step Navigation with Dynamic Validation
    if (btnNext) {
        btnNext.addEventListener('click', () => {
            const activePanel = document.getElementById(`step-panel-${currentStep}`);
            let valid = true;

            // Simple validation for inputs in current step
            const inputs = activePanel.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(i => {
                if(!i.value) { i.classList.add('tw:border-red-500'); valid = false; }
                else { i.classList.remove('tw:border-red-500'); }
            });

            if (valid && currentStep < totalSteps) {
                currentStep++;
                updateUI();
                const contactSection = document.getElementById('contacto');
                if (contactSection) {
                    window.scrollTo({ top: contactSection.offsetTop - 50, behavior: 'smooth' });
                }
            }
        });
    }

    if (btnBack) {
        btnBack.addEventListener('click', () => {
            if (currentStep > 1) { currentStep--; updateUI(); }
        });
    }

    // Conditional Contact Validation Logic
    function updateValidationRules() {
        const selectedChannel = contactForm.querySelector('input[name="dm_channel"]:checked')?.value;
        const phoneInput = document.getElementById('contacto-phone');
        const emailInput = document.getElementById('contacto-email');
        const phoneMark = document.querySelector('#phone-field-group .required-mark');
        const emailMark = document.querySelector('#email-field-group .required-mark');

        if (selectedChannel === 'whatsapp') {
            phoneInput.required = true;
            emailInput.required = false;
            phoneMark?.classList.remove('tw:hidden');
            emailMark?.classList.add('tw:hidden');
        } else {
            phoneInput.required = false;
            emailInput.required = true;
            phoneMark?.classList.add('tw:hidden');
            emailMark?.classList.remove('tw:hidden');
        }

        // Visual Radio Feedback
        contactForm.querySelectorAll('.opt-box').forEach(box => {
            box.classList.remove('tw:border-dm-accent', 'tw:bg-dm-accent/10');
            box.parentElement.querySelector('input').checked ? box.classList.add('tw:border-dm-accent', 'tw:bg-dm-accent/10') : null;
        });
    }

    contactForm.querySelectorAll('input[name="dm_channel"]').forEach(rad => {
        rad.addEventListener('change', updateValidationRules);
    });

    // Form Submission
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const channel = contactForm.querySelector('input[name="dm_channel"]:checked')?.value || 'whatsapp';
        const formData = new FormData(contactForm);
        formData.append('action', 'datamaq_submit_contact');
        formData.append('security', window.datamaq_vars?.nonce || '');

        btnSubmit.disabled = true;
        btnSubmit.textContent = 'Enviando...';

        try {
            if (channel === 'whatsapp') {
                const name = contactForm.dm_name.value;
                const phone = contactForm.dm_phone.value;
                const msg = contactForm.dm_message.value;
                const text = `Hola DataMaq, soy ${name}. Mi contacto es ${phone}. Mi consulta: ${msg}`;
                window.open(`https://wa.me/5491156297160?text=${encodeURIComponent(text)}`, '_blank');
            }

            const response = await fetch(window.datamaq_vars.ajax_url, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = window.datamaq_vars.thanks_url || '/gracias';
            } else {
                throw new Error(result.data.message || 'Error al enviar');
            }

        } catch (error) {
            console.error('Contact Error:', error);
            const errorMsg = document.getElementById('contact-error-msg');
            if (errorMsg) {
                errorMsg.classList.remove('tw:hidden');
                errorMsg.querySelector('p').textContent = error.message;
            }
            btnSubmit.disabled = false;
            btnSubmit.textContent = 'Finalizar envío';
        }
    });

    // Initial state
    updateValidationRules();
    updateUI();
});
