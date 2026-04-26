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
    <div class="tw:absolute tw:inset-0 tw:bg-gradient-to-b tw:from-cyan-500/5 tw:to-transparent"></div>
    
    <div class="tw:container tw:mx-auto tw:px-6 tw:relative tw:z-10">
        <div class="tw:max-w-5xl tw:mx-auto">
            
            <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-16 tw:items-start">
                
                <!-- Info Column (4 cols) -->
                <div class="lg:tw:col-span-12 tw:text-center tw:mb-8">
                    <span class="dm-eyebrow tw:text-center">&iquest;Hablamos?</span>
                    <h2 class="tw:text-white tw:text-4xl lg:tw:text-6xl tw:mt-4">Iniciar proyecto</h2>
                </div>

                <!-- Form Card (12 cols for centered high-impactwizard) -->
                <div class="lg:tw:col-span-10 lg:tw:col-start-2 tw:p-8 lg:tw:p-12 dm-contact-card">
                    
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




                </div>

            </div>
        </div>
    </div>
</section>
