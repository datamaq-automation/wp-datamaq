<?php
try {
    $viewModel = new \DataMaq\UI\ViewModels\ContactViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in ContactViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    return;
}
?>
<section id="contacto" data-dm-component="ScrollReveal" class="tw:py-10 tw:bg-dm-bg tw:text-dm-text-0 c-contact" aria-labelledby="contacto-title">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:flex tw:justify-center">
            <div class="tw:w-full tw:max-w-3xl">
                <div class="tw:bg-dm-surface tw:border tw:border-dm-border tw:rounded-2xl tw:shadow-2xl c-contact__card">
                    <div class="tw:p-5 tw:lg:p-8">
                        <h2 id="contacto-title" class="tw:text-2xl tw:lg:text-3xl tw:font-bold c-contact__title tw:mb-2"><?php echo esc_html($viewModel->getTitle()); ?></h2>
                        <p class="tw:text-dm-text-muted tw:mb-5 c-contact__subtitle"><?php echo esc_html($viewModel->getSubtitle()); ?></p>

                        <!-- Stepper -->
                        <ol class="c-contact__stepper" aria-label="Pasos del formulario">
                            <?php 
                            $steps = $viewModel->getSteps();
                            foreach ($steps as $index => $label) : 
                                $stepNum = $index + 1;
                                $isActive = ($stepNum === 1) ? 'is-active' : '';
                            ?>
                                <li class="c-contact__stepper-item <?php echo $isActive; ?>">
                                    <button type="button" class="c-contact__stepper-trigger" aria-label="And&aacute; al paso <?php echo $stepNum; ?>: <?php echo esc_attr($label); ?>">
                                        <span class="c-contact__stepper-dot" aria-hidden="true"><span><?php echo $stepNum; ?></span></span>
                                        <span class="c-contact__stepper-label"><?php echo esc_html($label); ?></span>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ol>

                        <!-- Progress -->
                        <div class="c-contact__progress" role="progressbar" aria-label="Progreso del formulario" aria-valuemin="1" aria-valuemax="3" aria-valuenow="1">
                            <div class="c-contact__progress-track">
                                <div class="c-contact__progress-fill" style="width: 33%;"></div>
                            </div>
                            <p class="c-contact__progress-text"><?php echo esc_html($viewModel->getProgressText(1, 3)); ?></p>
                            <p class="c-contact__privacy-note">Guardamos un borrador temporal de este formulario por hasta 12 horas en este dispositivo.</p>
                        </div>

                        <form class="tw:grid tw:grid-cols-1 tw:gap-4" novalidate="" aria-busy="false">
                            <div class="c-contact__step-panel" id="step-panel-1">
                                <h3 class="c-contact__step-title">1. <?php echo esc_html($steps[0]); ?></h3>
                                <div>
                                    <label class="c-contact__label" for="contacto-nombre">Nombre</label>
                                    <input id="contacto-nombre" name="dm_name" type="text" class="c-contact__input" autocomplete="given-name" maxlength="80" required>
                                    <small class="c-contact__helper">Obligatorio</small>
                                </div>
                                <div>
                                    <label class="c-contact__label" for="contacto-apellido">Apellido</label>
                                    <input id="contacto-apellido" name="dm_lastname" type="text" class="c-contact__input" autocomplete="family-name" maxlength="80">
                                    <small class="c-contact__helper">Opcional</small>
                                </div>
                            </div>

                            <!-- STEP 2: Project Details -->
                            <div class="c-contact__step-panel tw:hidden" id="step-panel-2">
                                <h3 class="c-contact__step-title">2. <?php echo esc_html($steps[1]); ?></h3>
                                <div>
                                    <label class="c-contact__label" for="contacto-mensaje">Detalles del proyecto o consulta</label>
                                    <textarea id="contacto-mensaje" name="dm_message" class="c-contact__input" rows="5" required placeholder="Describ&iacute; tu caso t&eacute;cnico..."></textarea>
                                    <small class="c-contact__helper">Obligatorio</small>
                                </div>
                            </div>

                            <!-- STEP 3: Contact Channels -->
                            <div class="c-contact__step-panel tw:hidden" id="step-panel-3">
                                <h3 class="c-contact__step-title">3. <?php echo esc_html($steps[2]); ?></h3>
                                <div class="tw:space-y-6">
                                    <label class="c-contact__label">¿Cómo prefieres que te contactemos?</label>
                                    <div class="tw:grid tw:grid-cols-2 tw:gap-4">
                                        <label class="tw:relative tw:cursor-pointer group">
                                            <input type="radio" name="dm_channel" value="whatsapp" checked class="tw:sr-only">
                                            <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-2xl tw:p-6 tw:text-center tw:transition-all tw:flex tw:flex-col tw:items-center tw:gap-4">
                                                <!-- Línea 1: El círculo -->
                                                <div class="opt-box__circle"></div>
                                                <!-- Línea 2: El icono -->
                                                <i class="bi bi-whatsapp tw:text-3xl"></i>
                                                <!-- Línea 3: El texto -->
                                                <span class="tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">WhatsApp</span>
                                            </div>
                                        </label>
                                        <label class="tw:relative tw:cursor-pointer group">
                                            <input type="radio" name="dm_channel" value="email" class="tw:sr-only">
                                            <div class="opt-box tw:border tw:border-white/10 tw:bg-white/5 tw:rounded-2xl tw:p-6 tw:text-center tw:transition-all tw:flex tw:flex-col tw:items-center tw:gap-4">
                                                <!-- Línea 1: El círculo -->
                                                <div class="opt-box__circle"></div>
                                                <!-- Línea 2: El icono -->
                                                <i class="bi bi-envelope tw:text-3xl"></i>
                                                <!-- Línea 3: El texto -->
                                                <span class="tw:text-[10px] tw:font-black tw:uppercase tw:tracking-widest">E-mail</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-2 tw:gap-6 tw:mt-8">
                                        <div id="phone-field-group">
                                            <label class="c-contact__label" for="contacto-phone">WhatsApp / Tel&eacute;fono <span class="required-mark">*</span></label>
                                            <input id="contacto-phone" name="dm_phone" type="tel" class="c-contact__input" placeholder="+54 9 11 ...">
                                        </div>
                                        <div id="email-field-group">
                                            <label class="c-contact__label" for="contacto-email">Correo electr&oacute;nico <span class="required-mark tw:hidden">*</span></label>
                                            <input id="contacto-email" name="dm_email" type="email" class="c-contact__input" placeholder="ejemplo@correo.com">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="c-contact__actions">
                                <button type="button" id="btn-next" class="c-contact__btn c-contact__btn--primary"> Continu&aacute; </button>
                                <button type="submit" id="btn-submit" class="c-contact__btn c-contact__btn--primary tw:hidden"> Finalizar env&iacute;o </button>
                            </div>

                            <div id="contact-error-msg" class="tw:hidden" aria-live="polite" aria-atomic="true">
                                <p class="tw:text-orange-200 tw:bg-orange-900/35 tw:border tw:border-orange-600 tw:rounded-xl tw:px-4 tw:py-3 tw:text-sm" role="status">Hubo un error al procesar tu solicitud.</p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Alternative Email Card -->
                <article class="c-contact__email-card" aria-label="Contacto alternativo por e-mail">
                    <p class="c-contact__email-label">Contacto alternativo</p>
                    <p class="c-contact__email-title">Escribinos por e-mail</p>
                    <a class="c-contact__email-link" href="mailto:<?php echo esc_attr($viewModel->getAlternativeEmail()); ?>"><?php echo esc_html($viewModel->getAlternativeEmail()); ?></a>
                </article>
            </div>
        </div>
    </div>
</section>
