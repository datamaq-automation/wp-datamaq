<?php
/**
 * Template Name: Página de Gracias
 */

get_header();

// Reuse FooterViewModel for brand data (WhatsApp, etc.)
$footerVM = new \DataMaq\UI\ViewModels\FooterViewModel(dm_content_repo());
?>

<div class="thanks-view thanks-shell">
    <a class="skip-link" href="#contenido-principal">Saltar al contenido principal</a>
    
    <main id="contenido-principal" class="thanks-stage" aria-labelledby="thanks-title">
        <header class="thanks-topbar">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="thanks-topbar__close" aria-label="Volv&eacute; al inicio">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </a>
            <h2 class="thanks-topbar__title">Solicitud finalizada</h2>
        </header>

        <section class="thanks-main">
            <div class="thanks-main__icon-wrap" aria-hidden="true">
                <div class="thanks-main__icon-glow"></div>
                <div class="thanks-main__icon">
                    <i class="bi bi-check-lg"></i>
                </div>
            </div>
            <p class="thanks-main__badge">Formulario enviado</p>
            <h1 id="thanks-title" class="thanks-main__title">&iexcl;Gracias!</h1>
            <p class="thanks-main__copy">Recibimos tu consulta. En breve te contactamos.</p>
        </section>

        <footer class="thanks-actions">
            <a href="<?php echo esc_url($footerVM->getWhatsAppUrl()); ?>" class="btn c-ui-btn c-ui-btn--primary thanks-actions__whatsapp">
                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                <span>Escribime por WhatsApp</span>
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn c-ui-btn c-ui-btn--outline thanks-actions__home">
                Volv&eacute; al inicio
            </a>
        </footer>

        <div class="thanks-stage__glow" aria-hidden="true"></div>
    </main>
</div>

<?php get_footer(); ?>
