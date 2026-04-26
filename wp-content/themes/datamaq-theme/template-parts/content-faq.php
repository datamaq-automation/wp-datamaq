<?php
/**
 * Template part for displaying FAQ section with V6 Absolute Parity.
 */
$data = dm_content_repo()->getSection('faq');
?>
<section id="faq" data-dm-component="ScrollReveal" class="c-home-faq tw:py-40 tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#ff6a00] tw:top-[-20%] tw:left-[-10%] tw:opacity-[0.1]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-5xl tw:mx-auto tw:text-center tw:mb-24">
            <span class="dm-eyebrow">
                <?php echo $data['eyebrow'] ?? 'Ayuda'; ?>
            </span>
            <h2 class="tw:text-6xl lg:tw:text-8xl tw:font-black tw:text-white tw:mb-10 tw:tracking-tighter">
                <?php echo $data['title']; ?>
            </h2>
            <p class="tw:text-3xl tw:text-white/60">
                Todo lo que necesit&aacute;s saber sobre nuestras soluciones y metodolog&iacute;a.
            </p>
        </div>

        <div class="tw:max-w-5xl tw:mx-auto tw:space-y-8">
            <?php foreach ($data['items'] as $item) : ?>
            <div class="c-home-faq__item dm-faq-item tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-white tw:text-3xl tw:pr-12 tw:tracking-tight">
                            <?php echo $item['q']; ?>
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="tw:text-white/80 tw:text-2xl tw:leading-relaxed">
                            <?php echo $item['a']; ?>
                        </p>
                    </div>
                </details>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



