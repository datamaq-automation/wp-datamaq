<?php
/**
 * Template part for displaying the Contact Page Header (Minimalist)
 */
$data = get_datamaq_site_data();
$brand = $data['brand'];
$contactPage = $data['contactPage'];
?>
<header class="tw:sticky tw:top-0 tw:z-[1040] tw:backdrop-blur-xl tw:bg-[#0c092f]/80 tw:border-b tw:border-white/10" role="banner">
    <div class="tw:container tw:mx-auto tw:px-4 tw:flex tw:items-center tw:justify-between tw:h-[4.5rem]">
        <a class="tw:inline-flex tw:items-center tw:gap-3  tw:no-underline tw:font-extrabold tw:tracking-tight" href="<?php echo home_url('/'); ?>" aria-label="DataMaq, inicio">
            <span class="tw:flex tw:items-center tw:justify-center tw:w-10 tw:h-10 tw:rounded-full tw:bg-[#ff9a4d]/10 tw:text-[#ff9a4d]" aria-hidden="true">
                <i class="bi bi-terminal-fill"></i>
            </span>
            <span><?php echo esc_html($brand['name']); ?></span>
        </a>

        <nav class="tw:hidden lg:tw:flex tw:items-center tw:gap-8" aria-label="Navegación de retorno">
            <?php foreach ($contactPage['introLinks'] as $link): ?>
            <a href="<?php echo esc_url($link['href']); ?>" class="/70 tw:no-underline tw:text-sm tw:font-medium hover:tw:text-[#ff9a4d] tw:transition-colors">
                <?php echo esc_html($link['label']); ?>
            </a>
            <?php endforeach; ?>
        </nav>

        <div class="tw:flex tw:items-center tw:gap-4">
            <a href="<?php echo home_url('/'); ?>" class="tw:btn-outline tw:px-6  tw:text-sm lg:tw:hidden">
                Inicio
            </a>
            <a href="<?php echo esc_url($brand['whatsapp']); ?>" class="tw:btn-primary tw:hidden lg:tw:inline-flex tw:px-6  tw:text-sm tw:font-black">
                Escribime
            </a>
        </div>
    </div>
</header>
