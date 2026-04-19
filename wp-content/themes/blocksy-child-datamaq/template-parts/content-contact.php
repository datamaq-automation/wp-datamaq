<?php
/**
 * Template part for displaying the contact section.
 */
$data = get_datamaq_site_data();
$contact = $data['contactPage'];
?>
<section id="contacto" class="tw:py-32 tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Ambient glow -->
    <div class="c-ambient-glow tw:bg-[#4299e1] tw:bottom-[-20%] tw:right-[-10%] tw:opacity-[0.1]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-2 tw:gap-24">
            
            <div class="tw:space-y-12">
                <div>
                    <span class="c-home-hero__eyebrow"><?php echo $contact['eyebrow']; ?></span>
                    <h2 class="tw:text-5xl md:tw:text-7xl tw:font-black tw:text-white tw:mb-8 tw:tracking-tighter">
                        <?php echo $contact['title']; ?>
                    </h2>
                    <p class="tw:text-2xl tw:text-white/70 tw:leading-relaxed">
                        <?php echo $contact['subtitle']; ?>
                    </p>
                </div>

                <div class="tw:space-y-8">
                    <h4 class="tw:text-white tw:font-bold tw:text-xl tw:uppercase tw:tracking-widest"><?php echo $contact['supportTitle']; ?></h4>
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

            <div class="tw:glass-card-intensive tw:p-12 tw:rounded-[3.5rem] tw:border-white/10">
                <form id="dm-contact-form" class="tw:space-y-8">
                    <div class="tw:space-y-3">
                        <label class="tw:text-white/60 tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">Nombre</label>
                        <input type="text" placeholder="<?php echo $contact['placeholderName']; ?>" class="tw:w-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-2xl tw:px-8 tw:py-5 tw:text-white tw:text-lg focus:tw:border-orange-400/50 tw:outline-none tw:transition-all">
                    </div>
                    <div class="tw:space-y-3">
                        <label class="tw:text-white/60 tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">Consulta t&eacute;cnica</label>
                        <textarea rows="4" placeholder="<?php echo $contact['placeholderMsg']; ?>" class="tw:w-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-2xl tw:px-8 tw:py-5 tw:text-white tw:text-lg focus:tw:border-orange-400/50 tw:outline-none tw:transition-all"></textarea>
                    </div>
                    <button type="button" class="tw:btn-primary tw:w-full tw:py-6 tw:text-xl tw:font-black tw:rounded-2xl">
                        <?php echo $contact['buttonLabel']; ?>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
