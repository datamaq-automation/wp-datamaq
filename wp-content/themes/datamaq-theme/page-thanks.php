<?php
/**
 * Template Name: Página de Gracias
 */

// No get_header() to keep it standalone and clean
$footerVM = new \DataMaq\UI\ViewModels\FooterViewModel(dm_content_repo());
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <style>
        :root {
            --contact-accent: #ff6a00;
        }
        /* Force body to be a full screen container for the thanks view */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #0c092f;
        }
        .thanks-view {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body <?php body_class(); ?>>

<div class="thanks-view thanks-shell">
    <a class="skip-link" href="#contenido-principal" style="position: absolute; left: -9999px;">Saltar al contenido principal</a>
    
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
            <a href="<?php echo esc_url($footerVM->getWhatsAppUrl()); ?>" class="thanks-actions__whatsapp">
                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                <span>Escribime por WhatsApp</span>
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="thanks-actions__home">
                Volv&eacute; al inicio
            </a>
        </footer>

        <div class="thanks-stage__glow" aria-hidden="true"></div>
    </main>
    
    <!-- WhatsApp FAB -->
    <a class="c-whatsapp-fab tw:fixed tw:right-4 tw:z-[1050] tw:flex tw:items-center tw:justify-center tw:w-14 tw:h-14 tw:text-white tw:rounded-full tw:shadow-lg tw:transition-transform hover:tw:scale-110 active:tw:scale-95" 
       href="<?php echo esc_url($footerVM->getWhatsAppUrl()); ?>" 
       target="_blank" rel="noopener noreferrer" aria-label="Abrir WhatsApp" title="Abrir WhatsApp">
       <svg class="c-whatsapp-fab__icon" viewBox="0 0 24 24" aria-hidden="true" style="width: 24px; height: 24px;">
            <path fill="currentColor" d="M12 2a9.8 9.8 0 0 0-8.38 14.87L2 22l5.28-1.57A9.8 9.8 0 1 0 12 2Zm0 17.65a7.9 7.9 0 0 1-4.03-1.1l-.3-.18-3.14.94.97-3.06-.2-.31A7.9 7.9 0 1 1 12 19.65Zm4.34-5.91c-.24-.12-1.4-.7-1.62-.77-.22-.08-.38-.12-.54.12-.16.23-.62.77-.76.92-.14.15-.28.18-.52.06-.24-.12-1-.38-1.92-1.2a7.2 7.2 0 0 1-1.33-1.64c-.14-.23 0-.36.1-.48.11-.11.24-.28.36-.42.12-.14.16-.23.24-.38.08-.15.04-.29-.02-.41-.06-.12-.54-1.31-.74-1.79-.2-.48-.41-.41-.56-.42h-.48a.92.92 0 0 0-.66.31c-.22.24-.84.82-.84 2s.86 2.31.98 2.47c.12.16 1.69 2.57 4.09 3.6.57.25 1.01.4 1.36.51.57.18 1.08.16 1.49.1.46-.07 1.4-.57 1.6-1.12.2-.55.2-1.02.14-1.12-.06-.09-.22-.15-.46-.27Z"></path>
       </svg>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
