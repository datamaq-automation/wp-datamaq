<?php
/**
 * Template part for displaying FAQ section with V6 Absolute Parity.
 */
$data = get_datamaq_site_data()['faq'];
?>
<section id="faq" class="tw:py-40 tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#ff6a00] tw:top-[-20%] tw:left-[-10%] tw:opacity-[0.1]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-5xl tw:mx-auto tw:text-center tw:mb-24">
            <span class="c-home-hero__eyebrow">Dudas comunes</span>
            <h2 class="tw:text-6xl lg:tw:text-8xl tw:font-black tw:text-white tw:mb-10 tw:tracking-tighter">
                Preguntas Frecuentes
            </h2>
            <p class="tw:text-3xl tw:text-white/60">
                Todo lo que necesit&aacute;s saber sobre nuestras soluciones y metodolog&iacute;a.
            </p>
        </div>

        <div class="tw:max-w-5xl tw:mx-auto tw:space-y-8">
            <div class="c-home-faq__item tw:glass-card-intensive tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-white tw:text-3xl tw:pr-12 tw:tracking-tight">
                            &iquest;Qu&eacute; tipo de datos se pueden capturar?
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="tw:text-white/80 tw:text-2xl tw:leading-relaxed">
                            Variables el&eacute;ctricas (kWh, potencia) u operativas (kilos, unidades, metros, estados).
                        </p>
                    </div>
                </details>
            </div>

            <div class="c-home-faq__item tw:glass-card-intensive tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-white tw:text-3xl tw:pr-12 tw:tracking-tight">
                            &iquest;Trabaj&aacute;s solo con energ&iacute;a el&eacute;ctrica?
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="tw:text-white/80 tw:text-2xl tw:leading-relaxed">
                            No. Tambi&eacute;n implementamos soluciones para datos de producci&oacute;n y procesos industriales.
                        </p>
                    </div>
                </details>
            </div>

            <div class="c-home-faq__item tw:glass-card-intensive tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-white tw:text-3xl tw:pr-12 tw:tracking-tight">
                            &iquest;Us&aacute;s Powermeter y Automate?
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="tw:text-white/80 tw:text-2xl tw:leading-relaxed">
                            S&iacute;. Seg&uacute;n el proyecto, usamos Powermeter para el&eacute;ctrica y Automate para se&ntilde;ales operativas.
                        </p>
                    </div>
                </details>
            </div>

            <div class="c-home-faq__item tw:glass-card-intensive tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-white tw:text-3xl tw:pr-12 tw:tracking-tight">
                            &iquest;Qu&eacute; necesit&aacute;s para evaluar el caso?
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="tw:text-white/80 tw:text-2xl tw:leading-relaxed">
                            Zona, fotos del tablero, variables a capturar, conectividad y sistema de destino.
                        </p>
                    </div>
                </details>
            </div>
        </div>
    </div>
</section>

<style>
/* Remove default details arrow */
summary::-webkit-details-marker {
  display: none;
}
</style>
