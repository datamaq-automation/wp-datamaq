<?php
/**
 * Template Name: Contact Page (V6 Absolute Parity)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$data = get_datamaq_site_data();
$contact = $data['contactPage'];
$brand = $data['brand'];

get_header();
?>

<div class="c-contact-page-shell tw:min-h-screen tw:bg-[#0c092f] tw:text-white tw:relative tw:overflow-hidden">
    <!-- Ambient radial glow -->
    <div style="position: absolute; top: 0; right: 0; width: 60%; height: 60%; background: radial-gradient(circle at top right, rgba(249, 115, 22, 0.14), transparent 70%); pointer-events: none; z-index: 1;"></div>
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, #0c092f 0%, #111827 40%, #1f2937 100%); pointer-events: none; z-index: 0;"></div>

    <main id="contenido-principal" class="tw:relative tw:z-[10] tw:pt-16 tw:pb-32">
        <section class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-12 tw:items-stretch">
                
                <!-- Left Panel: Intro -->
                <div class="lg:tw:col-span-5">
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" class="tw:h-full tw:p-8 md:tw:p-12 tw:rounded-[2rem] tw:shadow-2xl tw:flex tw:flex-col">
                        <span style="color: #ff6a00;" class="tw:font-black tw:uppercase tw:tracking-widest tw:text-xs tw:mb-6">
                            <?php echo $contact['eyebrow']; ?>
                        </span>
                        <h1 class="tw:text-5xl md:tw:text-7xl tw:font-black tw:text-white tw:mb-8 tw:tracking-tighter tw:leading-[0.95]">
                            <?php echo $contact['title']; ?>
                        </h1>
                        <p class="tw:text-xl tw:text-white/70 tw:leading-relaxed tw:mb-10">
                            <?php echo $contact['subtitle']; ?>
                        </p>

                        <!-- Navigation Chips (Absolute Links) -->
                        <div class="tw:flex tw:flex-wrap tw:gap-3 tw:mt-auto">
                            <a href="<?php echo home_url('/#servicios'); ?>" class="tw:px-6 tw:py-3 tw:border tw:border-white/10 tw:rounded-full tw:text-sm tw:text-white/80 tw:bg-white/5 hover:tw:bg-orange-500/20 hover:tw:text-orange-500 tw:transition-all">Soluci&oacute;n</a>
                            <a href="<?php echo home_url('/#perfil'); ?>" class="tw:px-6 tw:py-3 tw:border tw:border-white/10 tw:rounded-full tw:text-sm tw:text-white/80 tw:bg-white/5 hover:tw:bg-orange-500/20 hover:tw:text-orange-500 tw:transition-all">Perfil t&eacute;cnico</a>
                            <a href="<?php echo home_url('/#faq'); ?>" class="tw:px-6 tw:py-3 tw:border tw:border-white/10 tw:rounded-full tw:text-sm tw:text-white/80 tw:bg-white/5 hover:tw:bg-orange-500/20 hover:tw:text-orange-500 tw:transition-all">FAQ</a>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Support -->
                <div class="lg:tw:col-span-7">
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" class="tw:h-full tw:p-8 md:tw:p-12 tw:rounded-[2rem] tw:shadow-2xl tw:flex tw:flex-col">
                        <p style="color: #ff6a00;" class="tw:font-black tw:uppercase tw:tracking-widest tw:text-xs tw:mb-6">
                            <?php echo $contact['supportTitle']; ?>
                        </p>
                        
                        <!-- Support List -->
                        <ul class="tw:space-y-6 tw:mb-12">
                            <li class="tw:flex tw:items-start tw:gap-4">
                                <span style="background: rgba(255,106,0,0.1); color: #ff6a00;" class="tw:flex tw:items-center tw:justify-center tw:w-8 tw:h-8 tw:rounded-full tw:flex-shrink-0 tw:mt-1">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                                <span class="tw:text-lg tw:text-white/80">Formulario principal para consultas t&eacute;cnicas y comerciales.</span>
                            </li>
                            <li class="tw:flex tw:items-start tw:gap-4">
                                <span style="background: rgba(255,106,0,0.1); color: #ff6a00;" class="tw:flex tw:items-center tw:justify-center tw:w-8 tw:h-8 tw:rounded-full tw:flex-shrink-0 tw:mt-1">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                                <span class="tw:text-lg tw:text-white/80">WhatsApp directo para coordinaci&oacute;n r&aacute;pida cuando est&eacute; habilitado.</span>
                            </li>
                        </ul>

                        <!-- Action Buttons -->
                        <div class="tw:flex tw:flex-col md:tw:flex-row tw:gap-4 tw:mt-auto">
                             <a href="<?php echo esc_url($brand['whatsapp']); ?>" class="tw:btn tw:bg-orange-500 tw:text-[#0c092f] tw:font-black tw:py-4 tw:px-12 tw:rounded-xl tw:text-center hover:tw:bg-orange-400 tw:transition-all md:tw:flex-1" style="background-color: #ff6a00 !important; color: #0c092f !important;">
                                Escribime
                             </a>
                             <a href="<?php echo home_url('/'); ?>" class="tw:btn tw:border tw:border-white/20 tw:text-white tw:py-4 tw:px-12 tw:rounded-xl tw:text-center hover:tw:bg-white/5 tw:transition-all md:tw:flex-1">
                                Volv&eacute; al inicio
                             </a>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Contact Form Section & Technician Card -->
            <div class="tw:mt-12 tw:flex tw:flex-col tw:lg:flex-row tw:gap-12">
                
                <!-- Technician Card (Embedded) -->
                <div class="tw:lg:w-1/3">
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" class="tw:p-8 tw:rounded-[2.5rem] tw:shadow-xl">
                        <div class="tw:flex tw:items-center tw:gap-6 tw:mb-8">
                            <img src="/wp-content/uploads/2026/04/tecnico-a-cargo.webp" alt="Agustin Bustos" class="tw:w-20 tw:h-20 tw:rounded-2xl tw:object-cover tw:border tw:border-white/10">
                            <div>
                                <p style="color: #ff6a00;" class="tw:text-sm tw:font-bold tw:uppercase tw:tracking-widest">T&eacute;cnico a cargo</p>
                                <p class="tw:text-xl tw:font-black">Agustin Bustos</p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url($brand['whatsapp']); ?>" class="tw:flex tw:items-center tw:justify-center tw:gap-3 tw:w-full tw:py-4 tw:bg-green-500/10 tw:text-green-500 tw:font-bold tw:rounded-xl hover:tw:bg-green-500 hover:tw:text-white tw:transition-all">
                            <i class="bi bi-whatsapp"></i>
                            <span>Coordin&aacute; por WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Main Form -->
                <div class="tw:lg:w-2/3">
                    <?php get_template_part('template-parts/content', 'contact'); ?>
                </div>
            </div>

        </section>
    </main>

    <footer class="tw:relative tw:z-[10] tw:py-12 tw:border-t tw:border-white/10 tw:bg-[#0c092f]/90">
        <div class="tw:container tw:mx-auto tw:px-4 tw:flex tw:flex-col md:tw:flex-row tw:items-center tw:justify-between tw:gap-8">
            <div>
                <p class="tw:font-bold tw:text-xl tw:mb-1"><?php echo $brand['name']; ?></p>
                <p class="tw:text-white/50 tw:text-sm">&copy; <?php echo date('Y'); ?> DataMaq | <?php echo $brand['base']; ?></p>
            </div>
            <p class="tw:text-white/60 tw:text-sm md:tw:max-w-md tw:leading-relaxed">
                La informaci&oacute;n publicada es referencial y puede actualizarse seg&uacute;n alcance, tablero, se&ntilde;ales disponibles y condiciones de implementaci&oacute;n.
            </p>
            <a href="<?php echo esc_url($brand['whatsapp']); ?>" class="tw:text-orange-500 tw:font-bold tw:text-lg hover:tw:underline">
                Escribime
            </a>
        </div>
    </footer>
</div>

<?php get_footer(); ?>
