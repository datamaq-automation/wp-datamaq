<?php
/**
 * Template part for displaying the contact section with V6 Absolute Parity + 3-Step Wizard.
 */
$data = get_datamaq_site_data();
$contact_page = $data['contactPage'];
$primary_form = $data['primaryContactForm'];

$is_contact_page = is_page_template('page-contact.php');
?>
<section id="contacto" class="<?php echo $is_contact_page ? 'c-page-contact-form' : 'c-home-contact tw:py-32 tw:bg-[#0c092f]'; ?> tw:relative tw:overflow-hidden">
    <?php if (!$is_contact_page) : ?>
    <div class="tw:absolute tw:bottom-[-20%] tw:right-[-10%] tw:w-[60vw] tw:h-[60vw] tw:rounded-full tw:bg-[#4299e1]/10 tw:blur-[120px] tw:pointer-events-none"></div>
    <?php endif; ?>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 <?php echo $is_contact_page ? '' : 'lg:tw:grid-cols-2 tw:gap-24'; ?>">
            
            <?php if (!$is_contact_page) : ?>
            <div class="tw:space-y-12">
                <div>
                    <span class="c-home-contact__eyebrow" style="text-transform: uppercase; color: #ff6a00; font-weight: 800; letter-spacing: 0.14em; margin-bottom: 1.5rem; display: inline-block;">
                        <?php echo $contact_page['eyebrow']; ?>
                    </span>
                    <h2 class="tw:text-5xl md:tw:text-7xl tw:font-black tw:text-white tw:mb-8 tw:tracking-tighter" style="letter-spacing: -0.03em;">
                        <?php echo $primary_form['title']; ?>
                    </h2>
                    <p class="tw:text-2xl tw:text-white/70 tw:leading-relaxed">
                        <?php echo $primary_form['subtitle']; ?>
                    </p>
                </div>

                <div class="tw:space-y-8">
                    <h4 class="tw:text-white tw:font-bold tw:text-xl tw:uppercase tw:tracking-widest"><?php echo $contact_page['supportTitle']; ?></h4>
                    <div class="tw:flex tw:items-center tw:gap-6">
                        <a href="<?php echo esc_url($data['brand']['whatsapp']); ?>" class="tw:flex tw:items-center tw:justify-center tw:w-16 tw:h-16 tw:bg-green-500/10 tw:text-green-500 tw:text-4xl tw:rounded-2xl hover:tw:bg-green-500 hover:tw:text-white tw:transition-all">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="mailto:<?php echo esc_attr($data['brand']['email']); ?>" class="tw:flex tw:items-center tw:justify-center tw:w-16 tw:h-16 tw:bg-orange-400/10 tw:text-orange-400 tw:text-4xl tw:rounded-2xl hover:tw:bg-orange-400 hover:tw:text-white tw:transition-all">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="<?php echo $is_contact_page ? 'tw:max-w-3xl tw:mx-auto' : ''; ?> tw:glass-card-intensive tw:p-8 md:tw:p-12 tw:rounded-[2rem] md:tw:rounded-[3.5rem] tw:border-white/10" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);">
                
                <!-- Stepper Progress UI -->
                <div class="c-contact-stepper tw:mb-12">
                    <div class="tw:flex tw:items-center tw:justify-between tw:mb-4">
                        <span class="tw:text-white/40 tw:text-xs tw:font-bold tw:uppercase tw:tracking-widest" id="step-indicator">Paso 1 de 3</span>
                        <div class="tw:h-1.5 tw:w-32 tw:bg-white/10 tw:rounded-full tw:overflow-hidden">
                            <div id="step-progress-bar" class="tw:h-full tw:bg-[#ff6a00] tw:transition-all tw:duration-500" style="width: 33.33%;"></div>
                        </div>
                    </div>
                    <div class="tw:flex tw:gap-2">
                        <div class="step-dot active tw:h-1 tw:flex-1 tw:bg-[#ff6a00] tw:transition-all"></div>
                        <div class="step-dot tw:h-1 tw:flex-1 tw:bg-white/10 tw:transition-all"></div>
                        <div class="step-dot tw:h-1 tw:flex-1 tw:bg-white/10 tw:transition-all"></div>
                    </div>
                </div>

                <form id="dm-contact-form" action="<?php echo esc_url( home_url('/gracias') ); ?>" method="POST" class="tw:relative">
                    
                    <!-- STEP 1: Identity -->
                    <div class="dm-form-step active" id="step-1">
                        <div class="tw:space-y-8">
                            <h3 class="tw:text-white tw:text-xl tw:font-bold">Contame qui&eacute;n sos</h3>
                            <div class="tw:space-y-3">
                                <label class="tw:text-white/60 tw:text-xs tw:font-black tw:uppercase tw:tracking-widest">Nombre completo</label>
                                <input type="text" name="dm_name" required placeholder="<?php echo $contact_page['placeholderName']; ?>" class="tw:w-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-2xl tw:px-8 tw:py-4 tw:text-white tw:text-lg focus:tw:border-[#ff6a00]/50 tw:outline-none tw:transition-all">
                            </div>
                            <div class="tw:space-y-3">
                                <label class="tw:text-white/60 tw:text-xs tw:font-black tw:uppercase tw:tracking-widest">Empresa / Proyecto</label>
                                <input type="text" name="dm_company" placeholder="Nombre de tu organizaci&oacute;n" class="tw:w-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-2xl tw:px-8 tw:py-4 tw:text-white tw:text-lg focus:tw:border-[#ff6a00]/50 tw:outline-none tw:transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: Project -->
                    <div class="dm-form-step tw:hidden" id="step-2">
                        <div class="tw:space-y-8">
                            <h3 class="tw:text-white tw:text-xl tw:font-bold">Detalles de la consulta</h3>
                            <div class="tw:space-y-3">
                                <label class="tw:text-white/60 tw:text-xs tw:font-black tw:uppercase tw:tracking-widest">Consulta t&eacute;cnica</label>
                                <textarea name="dm_message" rows="4" placeholder="<?php echo $contact_page['placeholderMsg']; ?>" class="tw:w-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-2xl tw:px-8 tw:py-4 tw:text-white tw:text-lg focus:tw:border-[#ff6a00]/50 tw:outline-none tw:transition-all"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: Channel -->
                    <div class="dm-form-step tw:hidden" id="step-3">
                        <div class="tw:space-y-8">
                            <h3 class="tw:text-white tw:text-xl tw:font-bold">Preferencia de contacto</h3>
                            <div class="tw:grid tw:grid-cols-2 tw:gap-4">
                                <label class="channel-opt tw:relative tw:cursor-pointer">
                                    <input type="radio" name="dm_channel" value="whatsapp" checked class="tw:sr-only">
                                    <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-2xl tw:p-6 tw:text-center tw:transition-all">
                                        <i class="bi bi-whatsapp tw:text-3xl tw:mb-2 tw:block"></i>
                                        <span class="tw:text-sm tw:font-bold">WhatsApp</span>
                                    </div>
                                </label>
                                <label class="channel-opt tw:relative tw:cursor-pointer">
                                    <input type="radio" name="dm_channel" value="email" class="tw:sr-only">
                                    <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-2xl tw:p-6 tw:text-center tw:transition-all">
                                        <i class="bi bi-envelope-at tw:text-3xl tw:mb-2 tw:block"></i>
                                        <span class="tw:text-sm tw:font-bold">Email</span>
                                    </div>
                                </label>
                            </div>
                            <p class="tw:text-white/40 tw:text-xs">Al presionar enviar, abrir&eacute; un chat de WhatsApp con los datos precargados si eleg&iacute;s esa v&iacute;a.</p>
                        </div>
                    </div>

                    <!-- Navigation Actions -->
                    <div class="tw:mt-12 tw:flex tw:gap-4">
                        <button type="button" id="btn-back" class="tw:hidden tw:flex-1 tw:py-5 tw:rounded-xl tw:border tw:border-white/20 tw:text-white tw:font-bold tw:transition-all">Volver</button>
                        <button type="button" id="btn-next" class="tw:flex-[2] tw:py-5 tw:rounded-xl tw:bg-[#ff6a00] tw:text-[#0c092f] tw:font-bold tw:transition-all">Continuar</button>
                        <button type="submit" id="btn-submit" class="tw:hidden tw:flex-[2] tw:py-5 tw:rounded-xl tw:bg-[#ff6a00] tw:text-[#0c092f] tw:font-bold tw:transition-all">Enviar solicitud</button>
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
                            // Hide all steps
                            document.querySelectorAll('.dm-form-step').forEach(s => s.classList.add('tw:hidden'));
                            // Show current step
                            document.getElementById(`step-${currentStep}`).classList.remove('tw:hidden');
                            
                            // Update progress
                            progressBar.style.width = (currentStep / totalSteps * 100) + '%';
                            indicator.textContent = `Paso ${currentStep} de ${totalSteps}`;
                            
                            // Update dots
                            dots.forEach((dot, idx) => {
                                if (idx < currentStep) dot.classList.add('tw:bg-[#ff6a00]');
                                else dot.classList.remove('tw:bg-[#ff6a00]');
                            });

                            // Update buttons
                            btnBack.classList.toggle('tw:hidden', currentStep === 1);
                            btnNext.classList.toggle('tw:hidden', currentStep === totalSteps);
                            btnSubmit.classList.toggle('tw:hidden', currentStep !== totalSteps);
                        }

                        btnNext.addEventListener('click', () => {
                            // Simple validation
                            const inputs = document.getElementById(`step-${currentStep}`).querySelectorAll('input[required], textarea[required]');
                            let valid = true;
                            inputs.forEach(i => { if(!i.value) { i.classList.add('tw:border-red-500'); valid = false; } else { i.classList.remove('tw:border-red-500'); } });
                            
                            if (valid && currentStep < totalSteps) {
                                currentStep++;
                                updateUI();
                            }
                        });

                        btnBack.addEventListener('click', () => {
                            if (currentStep > 1) {
                                currentStep--;
                                updateUI();
                            }
                        });

                        // Styling for radio options
                        form.querySelectorAll('input[type="radio"]').forEach(rad => {
                            rad.addEventListener('change', () => {
                                form.querySelectorAll('.opt-box').forEach(box => box.classList.remove('tw:bg-[#ff6a00]/20', 'tw:border-[#ff6a00]/50'));
                                if(rad.checked) rad.nextElementSibling.classList.add('tw:bg-[#ff6a00]/20', 'tw:border-[#ff6a00]/50');
                            });
                        });
                        // Initial style for radio
                        form.querySelector('input[type="radio"]:checked').nextElementSibling.classList.add('tw:bg-[#ff6a00]/20', 'tw:border-[#ff6a00]/50');
                    });
                </script>

                <style>
                    .dm-form-step {
                        animation: fadeIn 0.4s ease-out;
                    }
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(10px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .channel-opt:hover .opt-box {
                        border-color: rgba(255, 106, 0, 0.4);
                        background-color: rgba(255, 106, 0, 0.05);
                    }
                </style>
            </div>

        </div>
    </div>
</section>
