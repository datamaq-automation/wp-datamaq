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
                                    <input id="contacto-nombre" type="text" class="c-contact__input" autocomplete="given-name" maxlength="80">
                                    <small class="c-contact__helper">Opcional</small>
                                </div>
                                <div>
                                    <label class="c-contact__label" for="contacto-apellido">Apellido</label>
                                    <input id="contacto-apellido" type="text" class="c-contact__input" autocomplete="family-name" maxlength="80">
                                    <small class="c-contact__helper">Opcional</small>
                                </div>
                            </div>

                            <div class="c-contact__actions">
                                <button type="button" class="c-contact__btn c-contact__btn--primary"> Continu&aacute; </button>
                            </div>

                            <div aria-live="polite" aria-atomic="true">
                                <p class="tw:text-orange-200 tw:bg-orange-900/35 tw:border tw:border-orange-600 tw:rounded-xl tw:px-4 tw:py-3 tw:text-sm" role="status">Servicio temporalmente no disponible.</p>
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
