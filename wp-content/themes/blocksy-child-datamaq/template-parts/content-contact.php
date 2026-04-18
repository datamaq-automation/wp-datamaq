<?php
/**
 * Template part for displaying the Contact section
 * PARITY REFACTOR: Multi-step Stepper Implementation
 */

$data = get_datamaq_site_data()['contactPage']; 
$brand = get_datamaq_site_data()['brand'];
?>
<section id="contacto" class="section-mobile tw:py-32 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <article class="tw:max-w-4xl tw:mx-auto tw:p-8 lg:tw:p-16 tw:bg-[#1a1c3d]/94 tw:backdrop-blur-xl tw:rounded-[3rem] tw:border tw:border-white/10 tw:shadow-2xl">
            
            <!-- Stepper Progress -->
            <div id="dm-stepper-progress" class="tw:mb-12">
                <div class="tw:flex tw:justify-between tw:mb-4 tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">
                    <span id="dm-step-label" class="tw:text-[#ff9a4d]">Paso 1 de 3</span>
                    <span class="tw:text-white/40">Identidad</span>
                </div>
                <div class="tw:h-2 tw:bg-white/5 tw:rounded-full tw:overflow-hidden">
                    <div id="dm-progress-bar" class="tw:h-full tw:bg-[#ff9a4d] tw:transition-all tw:duration-500 tw:ease-out" style="width: 33.33%"></div>
                </div>
            </div>

            <h2 class="tw:text-4xl tw:lg:text-5xl tw:font-bold tw:text-white tw:mb-4">
                <?php echo esc_html($data['title']); ?>
            </h2>
            <p class="tw:text-white/60 tw:mb-12 tw:text-xl">
                <?php echo esc_html($data['subtitle']); ?>
            </p>

            <form id="dm-contact-form" class="tw:grid tw:grid-cols-1 tw:gap-8" novalidate>
                <?php wp_nonce_field( 'dm_contact_nonce', 'dm_contact_nonce_field' ); ?>
                <input type="hidden" name="action" value="submit_contact">
                
                <!-- Step 1: Identity -->
                <div id="dm-step-1" class="dm-step-content tw:space-y-8">
                    <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-2 tw:gap-8">
                        <div class="tw:space-y-3">
                            <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Nombre</label>
                            <input type="text" name="first_name" required class="dm-input" placeholder="Ej: Agustín">
                        </div>
                        <div class="tw:space-y-3">
                            <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Apellido</label>
                            <input type="text" name="last_name" required class="dm-input" placeholder="Ej: Bustos">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Project -->
                <div id="dm-step-2" class="dm-step-content tw:hidden tw:space-y-8">
                    <div class="tw:space-y-3">
                        <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Empresa / Proyecto</label>
                        <input type="text" name="company" required class="dm-input" placeholder="Nombre de la empresa">
                    </div>
                    <div class="tw:space-y-3">
                        <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Detalle el desafío... (Opcional)</label>
                        <textarea name="message" rows="4" class="dm-input" placeholder="Medición de kWh, integración IoT..."></textarea>
                    </div>
                </div>

                <!-- Step 3: Contact & Channel -->
                <div id="dm-step-3" class="dm-step-content tw:hidden tw:space-y-8">
                    <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-2 tw:gap-8">
                        <div class="tw:space-y-3">
                            <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">E-mail</label>
                            <input type="email" name="email" required class="dm-input" placeholder="tu@email.com">
                        </div>
                        <div class="tw:space-y-3">
                            <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Teléfono</label>
                            <input type="tel" name="phone" class="dm-input" placeholder="+54 9 11 ...">
                        </div>
                    </div>
                    <div class="tw:space-y-4">
                        <label class="tw:block tw:text-xs tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">Canal de respuesta preferido</label>
                        <div class="tw:flex tw:gap-4">
                            <label class="tw:flex-1 tw:cursor-pointer">
                                <input type="radio" name="preferred_channel" value="whatsapp" checked class="tw:hidden peer">
                                <div class="tw:p-4 tw:text-center tw:border tw:border-white/10 tw:rounded-xl tw:text-white/60 peer-checked:tw:bg-[#ff9a4d] peer-checked:tw:text-[#0c092f] peer-checked:tw:font-bold tw:transition-all">WhatsApp</div>
                            </label>
                            <label class="tw:flex-1 tw:cursor-pointer">
                                <input type="radio" name="preferred_channel" value="email" class="tw:hidden peer">
                                <div class="tw:p-4 tw:text-center tw:border tw:border-white/10 tw:rounded-xl tw:text-white/60 peer-checked:tw:bg-[#ff9a4d] peer-checked:tw:text-[#0c092f] peer-checked:tw:font-bold tw:transition-all">Email</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="tw:mt-12 tw:flex tw:justify-between tw:gap-4">
                    <button type="button" id="dm-prev-btn" class="tw:hidden tw:btn-outline tw:px-8 tw:py-4">Volvé</button>
                    <div class="tw:flex-1"></div>
                    <button type="button" id="dm-next-btn" class="tw:btn-primary tw:px-12 tw:py-4 tw:text-lg tw:font-black">Continuá</button>
                    <button type="submit" id="dm-submit-btn" class="tw:hidden tw:btn-primary tw:px-12 tw:py-4 tw:text-lg tw:font-black">Enviá tu solicitud</button>
                </div>

                <p id="dm-form-feedback" class="tw:mt-8 tw:text-center tw:text-xl tw:font-bold tw:hidden"></p>
            </form>
        </article>
    </div>

    <style>
        .dm-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            color: white;
            font-size: 1.125rem;
            outline: none;
            transition: all 0.3s ease;
        }
        .dm-input:focus {
            border-color: #ff9a4d;
            background: rgba(255, 154, 77, 0.05);
        }
        @media (max-width: 768px) {
            #dm-contact-form .tw:flex-wrap { flex-direction: column-reverse; }
            #dm-contact-form button { width: 100%; }
        }
    </style>

    <script>
    (function() {
        let currentStep = 1;
        const totalSteps = 3;
        const form = document.getElementById('dm-contact-form');
        const nextBtn = document.getElementById('dm-next-btn');
        const prevBtn = document.getElementById('dm-prev-btn');
        const submitBtn = document.getElementById('dm-submit-btn');
        const progressBar = document.getElementById('dm-progress-bar');
        const stepLabel = document.getElementById('dm-step-label');

        const updateStepper = () => {
            document.querySelectorAll('.dm-step-content').forEach((el, i) => {
                el.classList.toggle('tw:hidden', i + 1 !== currentStep);
            });
            prevBtn.classList.toggle('tw:hidden', currentStep === 1);
            nextBtn.classList.toggle('tw:hidden', currentStep === totalSteps);
            submitBtn.classList.toggle('tw:hidden', currentStep !== totalSteps);
            
            const percent = (currentStep / totalSteps) * 100;
            progressBar.style.width = percent + '%';
            stepLabel.textContent = `Paso ${currentStep} de ${totalSteps}`;
        };

        nextBtn.onclick = () => { if(currentStep < totalSteps) { currentStep++; updateStepper(); } };
        prevBtn.onclick = () => { if(currentStep > 1) { currentStep--; updateStepper(); } };

        if (form) {
            form.onsubmit = async function(e) {
                e.preventDefault();
                const fb = document.getElementById('dm-form-feedback');
                
                submitBtn.disabled = true; 
                fb.classList.remove('tw:hidden');
                fb.textContent = 'Procesando tu solicitud técnica...'; 
                fb.style.color = '#fff';
                
                try {
                    const res = await fetch('https://datamaq.com.ar/wp-admin/admin-ajax.php', {
                        method: 'POST',
                        body: new FormData(form)
                    });
                    const d = await res.json();
                    fb.textContent = d.data.message;
                    fb.style.color = d.success ? '#ff9a4d' : '#ef4444';
                    if (d.success) {
                        setTimeout(() => {
                            form.reset();
                            currentStep = 1;
                            updateStepper();
                            fb.classList.add('tw:hidden');
                        }, 5000);
                    }
                } catch (err) { 
                    fb.textContent = 'Error de conexión. Intentá por WhatsApp.'; 
                    fb.style.color = '#ef4444'; 
                } finally { 
                    submitBtn.disabled = false; 
                }
            };
        }
    })();
    </script>
</section>
