<?php
/**
 * Template part for displaying the Contact Form wizard with V6 Absolute Parity.
 * This file is used both as a section on the home page and as the main content on the contact page.
 */
$is_standalone = is_page_template('page-contact.php');
$contact_page = get_datamaq_site_data()['contactPage'];
?>
<section id="contacto" class="tw:relative tw:py-24 tw:overflow-hidden">
    <!-- Grid Pattern refinement -->
    <div class="tw:absolute tw:inset-0" style="background-image: radial-gradient(circle at 50% 50%, rgba(34, 211, 238, 0.03), transparent 70%);"></div>
    
    <div class="tw:container tw:mx-auto tw:px-6 tw:relative tw:z-10">
        <div class="tw:max-w-5xl tw:mx-auto">
            
            <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-16 tw:items-start">
                
                <!-- Info Column (4 cols) -->
                <div class="lg:tw:col-span-12 tw:text-center tw:mb-8">
                    <span class="c-home-eyebrow tw:text-[#ff6a00] tw:font-black">&iquest;Hablamos?</span>
                    <h2 class="tw:text-white tw:text-4xl lg:tw:text-6xl tw:mt-4">Iniciar proyecto</h2>
                </div>

                <!-- Form Card (12 cols for centered high-impactwizard) -->
                <div class="lg:tw:col-span-10 lg:tw:col-start-2 tw:p-8 lg:tw:p-12 tw:rounded-[2.5rem] tw:border tw:border-white/10 tw:shadow-2xl" 
                     style="background: rgba(12, 9, 47, 0.72); backdrop-filter: blur(28px); -webkit-backdrop-filter: blur(28px); box-shadow: 0 40px 100px rgba(0,0,0,0.4);">
                    
                    <!-- Progress Stepper -->
                    <div class="tw:mb-16">
                        <div class="tw:flex tw:items-center tw:justify-between tw:mb-4">
                            <span id="step-indicator" class="tw:text-white/40 tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">Paso 1 de 3</span>
                            <div class="tw:flex tw:gap-2">
                                <div class="step-dot tw:w-2 tw:h-2 tw:rounded-full tw:bg-white/10 tw:transition-all"></div>
                                <div class="step-dot tw:w-2 tw:h-2 tw:rounded-full tw:bg-white/10 tw:transition-all"></div>
                                <div class="step-dot tw:w-2 tw:h-2 tw:rounded-full tw:bg-white/10 tw:transition-all"></div>
                            </div>
                        </div>
                        <div class="tw:h-[2px] tw:w-full tw:bg-white/5 tw:relative tw:overflow-hidden tw:rounded-full">
                            <div id="step-progress-bar" class="tw:absolute tw:left-0 tw:top-0 tw:h-full tw:bg-[#ff6a00] tw:transition-all tw:duration-500" style="width: 33.33%;"></div>
                        </div>
                    </div>

                    <form id="dm-contact-form" action="#" method="POST">
                        <!-- STEP 1: Identity -->
                        <div class="dm-form-step" id="step-1">
                            <div class="tw:space-y-12">
                                <h3 class="tw:text-white tw:text-2xl tw:font-black tw:tracking-tight">&iquest;C&oacute;mo te llamas?</h3>
                                <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-2 tw:gap-8">
                                    <div class="tw:space-y-3">
                                        <label class="tw:text-white/40 tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">Nombre y Apellido</label>
                                        <input type="text" name="dm_name" required placeholder="Tu respuesta" class="dm-input-v6">
                                    </div>
                                    <div class="tw:space-y-3">
                                        <label class="tw:text-white/40 tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">Empresa o Proyecto</label>
                                        <input type="text" name="dm_company" required placeholder="Tu respuesta" class="dm-input-v6">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: Message -->
                        <div class="dm-form-step tw:hidden" id="step-2">
                            <div class="tw:space-y-12">
                                <h3 class="tw:text-white tw:text-2xl tw:font-black tw:tracking-tight">Detalles del proyecto</h3>
                                <div class="tw:space-y-3">
                                    <label class="tw:text-white/40 tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">Consulta t&eacute;cnica o comercial</label>
                                    <textarea name="dm_message" required rows="6" placeholder="&iquest;En qu&eacute; podemos ayudarte?" class="dm-input-v6 tw:py-6"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 3: Contact Preferences -->
                        <div class="dm-form-step tw:hidden" id="step-3">
                            <div class="tw:space-y-12">
                                <h3 class="tw:text-white tw:text-2xl tw:font-black tw:tracking-tight">V&iacute;a de contacto</h3>
                                <div class="tw:grid tw:grid-cols-1 sm:tw:grid-cols-2 tw:gap-6">
                                    <label class="channel-opt tw:relative tw:cursor-pointer">
                                        <input type="radio" name="dm_channel" value="whatsapp" checked class="tw:sr-only">
                                        <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-3xl tw:p-8 tw:text-center tw:transition-all">
                                            <i class="bi bi-whatsapp tw:text-4xl tw:mb-4 tw:block"></i>
                                            <span class="tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">WhatsApp</span>
                                        </div>
                                    </label>
                                    <label class="channel-opt tw:relative tw:cursor-pointer">
                                        <input type="radio" name="dm_channel" value="email" class="tw:sr-only">
                                        <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-3xl tw:p-8 tw:text-center tw:transition-all">
                                            <i class="bi bi-envelope-at tw:text-4xl tw:mb-4 tw:block"></i>
                                            <span class="tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">V&iacute;a Email</span>
                                        </div>
                                    </label>
                                </div>
                                <p class="tw:text-white/30 tw:text-xs tw:text-center">Al elegir WhatsApp, abrir&aacute; un chat directo con tu mensaje listo para enviar.</p>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="tw:mt-16 tw:flex tw:gap-4">
                            <button type="button" id="btn-back" class="tw:hidden tw:flex-1 tw:py-6 tw:rounded-2xl tw:border tw:border-white/20 tw:text-white tw:font-black tw:uppercase tw:tracking-widest tw:text-[10px] tw:transition-all hover:tw:bg-white/5">Volver</button>
                            <button type="button" id="btn-next" class="tw:flex-[2] tw:py-6 tw:rounded-2xl tw:bg-[#ff6a00] tw:text-[#0c092f] tw:font-black tw:uppercase tw:tracking-widest tw:text-[10px] tw:transition-all hover:tw:scale-[1.02]">Siguiente paso</button>
                             <button type="submit" id="btn-submit" class="tw:hidden tw:flex-[2] tw:py-6 tw:rounded-2xl tw:bg-[#ff6a00] tw:text-[#0c092f] tw:font-black tw:uppercase tw:tracking-widest tw:text-[10px] tw:transition-all hover:tw:scale-[1.02]">Finalizar env&iacute;o</button>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let currentStep = 1;
                            const totalSteps = 3;
                            
                            const form = document.getElementById('dm-contact-form');
                            const btnNext = document.getElementById('btn-next');
                            const btnBack = document.getElementById('btn-back');
                            const btnSubmit = document.getElementById('btn-submit');
                            const progressBar = document.getElementById('step-progress-bar');
                            const indicator = document.getElementById('step-indicator');
                            const dots = document.querySelectorAll('.step-dot');

                            function updateUI() {
                                document.querySelectorAll('.dm-form-step').forEach(s => s.classList.add('tw:hidden'));
                                document.getElementById(`step-${currentStep}`).classList.remove('tw:hidden');
                                progressBar.style.width = (currentStep / totalSteps * 100) + '%';
                                indicator.textContent = `Paso ${currentStep} de ${totalSteps}`;
                                dots.forEach((dot, idx) => {
                                    if (idx < currentStep) dot.classList.add('tw:bg-[#ff6a00]', 'tw:scale-125');
                                    else dot.classList.remove('tw:bg-[#ff6a00]', 'tw:scale-125');
                                });
                                btnBack.classList.toggle('tw:hidden', currentStep === 1);
                                btnNext.classList.toggle('tw:hidden', currentStep === totalSteps);
                                btnSubmit.classList.toggle('tw:hidden', currentStep !== totalSteps);
                            }

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
                                    window.scrollTo({ top: document.querySelector('#contacto').offsetTop - 100, behavior: 'smooth' });
                                }
                            });

                            btnBack.addEventListener('click', () => {
                                if (currentStep > 1) { currentStep--; updateUI(); }
                            });

                            // WhatsApp Integration
                            form.addEventListener('submit', (e) => {
                                const channel = form.querySelector('input[name="dm_channel"]:checked').value;
                                if (channel === 'whatsapp') {
                                    e.preventDefault();
                                    const name = form.dm_name.value;
                                    const company = form.dm_company.value;
                                    const msg = form.dm_message.value;
                                    const text = `Hola, soy ${name} de ${company}. ${msg}`;
                                    window.open(`https://wa.me/5491156297160?text=${encodeURIComponent(text)}`, '_blank');
                                    // Move to thanks anyway
                                    window.location.href = '<?php echo home_url('/gracias'); ?>';
                                }
                                // If email, let WP standard form handle (if integrated, otherwise we'd need a backend endpoint)
                            });

                            // Radio Toggle
                            form.querySelectorAll('input[type="radio"]').forEach(rad => {
                                rad.addEventListener('change', () => {
                                    form.querySelectorAll('.opt-box').forEach(box => box.classList.remove('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40'));
                                    if(rad.checked) rad.nextElementSibling.classList.add('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40');
                                });
                            });
                            form.querySelector('input[type="radio"]:checked').nextElementSibling.classList.add('tw:bg-[#ff6a00]/15', 'tw:border-[#ff6a00]/40');
                        });
                    </script>

                    <style>
                        .dm-input-v6 {
                            width: 100%;
                            background: rgba(255, 255, 255, 0.03) !important;
                            border: 1px solid rgba(255, 255, 255, 0.1) !important;
                            border-radius: 1.25rem !important;
                            padding: 1.25rem 2rem !important;
                            color: white !important;
                            font-size: 1.15rem !important;
                            outline: none !important;
                            transition: all 0.3s ease !important;
                        }
                        .dm-input-v6:focus {
                            background: rgba(255, 255, 255, 0.05) !important;
                            border-color: rgba(255, 106, 0, 0.4) !important;
                            box-shadow: 0 0 0 4px rgba(255, 106, 0, 0.1);
                        }
                        .dm-form-step { animation: stepIn 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
                        @keyframes stepIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
                        .channel-opt:hover .opt-box { border-color: rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.05); }
                    </style>
                </div>

            </div>
        </div>
    </div>
</section>
