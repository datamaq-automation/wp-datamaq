<?php
/**
 * Template Name: Contacto Técnico
 */

get_header();

$viewModel = new \DataMaq\UI\ViewModels\ContactPageViewModel(dm_content_repo());
?>

<main id="contenido-principal" class="c-contact-page-main">
    <!-- Hero Section -->
    <section class="section-mobile c-contact-page-hero" aria-labelledby="contact-page-title">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-8 tw:items-stretch">
                
                <!-- Intro Panel -->
                <div class="tw:col-span-1 lg:tw:col-span-5">
                    <article class="c-contact-page-panel c-contact-page-panel--intro">
                        <span class="c-contact-page-eyebrow">Contacto</span>
                        <h1 id="contact-page-title" class="c-contact-page-title"><?php echo esc_html($viewModel->getTitle()); ?></h1>
                        <p class="c-contact-page-copy"><?php echo $viewModel->getIntroCopy(); ?></p>
                        <div class="c-contact-page-chips" aria-label="Accesos a la home">
                            <a href="<?php echo esc_url($viewModel->getServicesLink()); ?>" class="c-contact-page-chip">Soluci&oacute;n</a>
                            <a href="<?php echo esc_url(home_url('/#perfil')); ?>" class="c-contact-page-chip">Perfil t&eacute;cnico</a>
                            <a href="<?php echo esc_url(home_url('/#faq')); ?>" class="c-contact-page-chip">FAQ</a>
                        </div>
                    </article>
                </div>

                <!-- Support Panel -->
                <div class="tw:col-span-1 lg:tw:col-span-7">
                    <article class="c-contact-page-panel c-contact-page-panel--support">
                        <p class="c-contact-page-support-label">Canales disponibles</p>
                        <ul class="c-contact-page-support-list">
                            <?php foreach ($viewModel->getSupportChannels() as $channel) : ?>
                                <li><?php echo $channel; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="c-contact-page-support-actions">
                            <button type="button" class="btn c-ui-btn c-ui-btn--primary" onclick="document.getElementById('contacto').scrollIntoView({behavior: 'smooth'})">Escribime</button>
                            <a href="<?php echo esc_url($viewModel->getHomeLink()); ?>" class="btn c-ui-btn c-ui-btn--outline">Volv&eacute; al inicio</a>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>

    <!-- Técnico a Cargo Card (Optional UI enhancement before the form) -->
    <div class="tw:container tw:mx-auto tw:px-4 tw:mt-10">
        <div class="tw:flex tw:justify-center">
            <div class="tw:w-full tw:max-w-3xl">
                <div data-v-9736d982="" class="card c-ui-card tw:border-orange-500/30 tw:border-2 tw:shadow-sm tw:bg-dm-surface/50 tw:backdrop-blur-sm tw:rounded-2xl tw:mb-6">
                    <div class="card-body tw:p-6 tw:text-center">
                        <div class="c-tecnico-avatar tw:mx-auto tw:mb-4">
                            <img src="<?php echo esc_url($viewModel->getTechnicianAvatar()); ?>" alt="Foto del t&eacute;cnico a cargo" class="tw:rounded-full tw:border-4 tw:border-orange-500/20" width="100" height="100" loading="lazy">
                        </div>
                        <p class="tw:text-xs tw:font-black tw:uppercase tw:text-orange-500 tw:tracking-widest tw:mb-1">T&eacute;cnico a cargo</p>
                        <h3 class="tw:text-xl tw:font-bold tw:mb-4"><?php echo esc_html($viewModel->getTechnicianName()); ?></h3>
                        <a href="https://wa.me/5491156297160?text=Hola+Agustin%2C+necesito+asistencia+t%C3%A9cnica." target="_blank" class="btn c-ui-btn c-ui-btn--primary tw:w-full lg:tw:w-auto lg:tw:px-10">Coordin&aacute; por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Wizard (Reused from template-parts) -->
    <?php get_template_part('template-parts/content', 'contact'); ?>

    <!-- Custom Contact Footer -->
    <footer class="c-contact-page-footer tw:py-10 tw:mt-20 tw:border-t tw:border-white/5">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:flex tw:flex-col lg:tw:flex-row tw:items-center tw:justify-between tw:gap-8">
                <div>
                    <p class="tw:text-2xl tw:font-black tw:mb-1">DataMaq</p>
                    <p class="tw:text-xs tw:opacity-40">(c) 2026 DataMaq | Gar&iacute;n (GBA Norte)</p>
                </div>
                <p class="tw:max-w-2xl tw:text-[10px] tw:opacity-30 tw:text-center lg:tw:text-left">
                    La informaci&oacute;n publicada es referencial y puede actualizarse seg&uacute;n alcance, tablero, se&ntilde;ales disponibles, conectividad, sistema destino y condiciones de implementaci&oacute;n.
                </p>
                <a href="https://wa.me/5491156297160" class="c-contact-page-footer__whatsapp tw:font-bold tw:text-orange-500" target="_blank">Escribime</a>
            </div>
        </div>
    </footer>
</main>

<?php get_footer(); ?>
