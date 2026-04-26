/**
 * DataMaq Contact Wizard JS
 * Handles multi-step form navigation and WhatsApp integration.
 */
document.addEventListener('DOMContentLoaded', () => {
    let currentStep = 1;
    const totalSteps = 3;
    
    const form = document.getElementById('dm-contact-form');
    if (!form) return;

    const btnNext = document.getElementById('btn-next');
    const btnBack = document.getElementById('btn-back');
    const btnSubmit = document.getElementById('btn-submit');
    const progressBar = document.getElementById('step-progress-bar');
    const indicator = document.getElementById('step-indicator');
    const dots = document.querySelectorAll('.step-dot');

    function updateUI() {
        document.querySelectorAll('.dm-form-step').forEach(s => s.classList.add('tw:hidden'));
        const activeStepEl = document.getElementById(`step-${currentStep}`);
        if (activeStepEl) activeStepEl.classList.remove('tw:hidden');
        
        if (progressBar) progressBar.style.width = (currentStep / totalSteps * 100) + '%';
        if (indicator) indicator.textContent = `Paso ${currentStep} de ${totalSteps}`;
        
        dots.forEach((dot, idx) => {
            if (idx < currentStep) dot.classList.add('tw:bg-[#ff6a00]', 'tw:scale-125');
            else dot.classList.remove('tw:bg-[#ff6a00]', 'tw:scale-125');
        });
        
        if (btnBack) btnBack.classList.toggle('tw:hidden', currentStep === 1);
        if (btnNext) btnNext.classList.toggle('tw:hidden', currentStep === totalSteps);
        if (btnSubmit) btnSubmit.classList.toggle('tw:hidden', currentStep !== totalSteps);
    }

    if (btnNext) {
        btnNext.addEventListener('click', () => {
            const activeStep = document.getElementById(`step-${currentStep}`);
            const inputs = activeStep.querySelectorAll('input[required], textarea[required]');
            let valid = true;
            inputs.forEach(i => {
                if(!i.value) { i.classList.add('tw:border-red-500/50'); valid = false; }
                else { i.classList.remove('tw:border-red-500/50'); }
            });
            if (valid && currentStep < totalSteps) {
                currentStep++;
                updateUI();
                const contactSection = document.querySelector('#contacto');
                if (contactSection) {
                    window.scrollTo({ top: contactSection.offsetTop - 100, behavior: 'smooth' });
                }
            }
        });
    }

    if (btnBack) {
        btnBack.addEventListener('click', () => {
            if (currentStep > 1) { currentStep--; updateUI(); }
        });
    }

    // WhatsApp Integration
    form.addEventListener('submit', (e) => {
        const channelInput = form.querySelector('input[name="dm_channel"]:checked');
        const channel = channelInput ? channelInput.value : 'email';
        
        if (channel === 'whatsapp') {
            e.preventDefault();
            const name = form.dm_name.value;
            const company = form.dm_company.value;
            const msg = form.dm_message.value;
            const text = `Hola, soy ${name} de ${company}. ${msg}`;
            window.open(`https://wa.me/5491156297160?text=${encodeURIComponent(text)}`, '_blank');
            
            // Redirect to thanks page
            const thanksUrl = (window.datamaq_vars && window.datamaq_vars.thanks_url) ? window.datamaq_vars.thanks_url : '/gracias';
            window.location.href = thanksUrl;
        }
    });

    // Radio Toggle Styling
    form.querySelectorAll('input[type="radio"]').forEach(rad => {
        rad.addEventListener('change', () => {
            form.querySelectorAll('.opt-box').forEach(box => box.classList.remove('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40'));
            if(rad.checked) rad.nextElementSibling.classList.add('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40');
        });
    });
    
    const checkedRadio = form.querySelector('input[type="radio"]:checked');
    if (checkedRadio && checkedRadio.nextElementSibling) {
        checkedRadio.nextElementSibling.classList.add('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40');
    }
});
