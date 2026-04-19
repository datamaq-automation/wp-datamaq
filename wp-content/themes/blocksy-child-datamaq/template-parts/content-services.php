<?php
/**
 * Template part for displaying services section with V6 Absolute Parity.
 */
$data = get_datamaq_site_data()['services'];
?>
<section id="servicios" class="tw:py-32 tw:bg-[#111229] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#4299e1] tw:top-[-20%] tw:right-[-10%] tw:opacity-[0.12]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-5xl tw:mb-24">
            <span class="c-home-hero__eyebrow">Soluciones T&eacute;cnicas</span>
            <h2 class="tw:text-6xl lg:tw:text-8xl tw:font-black tw:text-white tw:mb-10 tw:tracking-tighter">
                Ingenier&iacute;a aplicada a resultados
            </h2>
            <p class="tw:text-3xl tw:text-white/60 tw:leading-relaxed tw:max-w-3xl">
                Optimizamos la eficiencia operativa mediante tecnolog&iacute;a de vanguardia y an&aacute;lisis de datos en tiempo real.
            </p>
        </div>

        <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-3 tw:gap-14">
            <article class="tw:p-14 tw:glass-card-intensive tw:glow-azure tw:rounded-[4rem] tw:flex tw:flex-col tw:transition-all tw:group">
                <div class="tw:flex-1">
                    <h3 class="tw:text-3xl tw:font-black tw:text-white tw:mb-4">Instalaci&oacute;n IoT</h3>
                    <p class="tw:text-orange-400 tw:text-sm tw:font-black tw:uppercase tw:tracking-[0.3em] tw:mb-12">Captura y Comunicaci&oacute;n</p>
                    <ul class="tw:space-y-6 tw:mb-16">
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Medici&oacute;n de kWh y potencia</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Captura de kilos y unidades</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Integraci&oacute;n con sistemas</span>
                        </li>
                    </ul>
                </div>
                <div class="tw:pt-8">
                    <a href="#contacto" class="tw:btn-outline tw:w-full tw:text-xl tw:font-black tw:py-6 tw:border-white/10 group-hover:tw:border-orange-400/50">
                        Consult&aacute; por instalaci&oacute;n
                    </a>
                </div>
            </article>

            <article class="tw:p-14 tw:glass-card-intensive tw:glow-orange tw:rounded-[4rem] tw:flex tw:flex-col tw:transition-all tw:group">
                <div class="tw:flex-1">
                    <h3 class="tw:text-3xl tw:font-black tw:text-white tw:mb-4">Asesoramiento</h3>
                    <p class="tw:text-orange-400 tw:text-sm tw:font-black tw:uppercase tw:tracking-[0.3em] tw:mb-12">Datos y Estructura</p>
                    <ul class="tw:space-y-6 tw:mb-16">
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>An&aacute;lisis de consumo el&eacute;ctrico</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Ordenamiento de bases y APIs</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Soporte para reportes t&eacute;cnicos</span>
                        </li>
                    </ul>
                </div>
                <div class="tw:pt-8">
                    <a href="#contacto" class="tw:btn-outline tw:w-full tw:text-xl tw:font-black tw:py-6 tw:border-white/10 group-hover:tw:border-orange-400/50">
                        Consult&aacute; asesoramiento
                    </a>
                </div>
            </article>

            <article class="tw:p-14 tw:glass-card-intensive tw:glow-azure tw:rounded-[4rem] tw:flex tw:flex-col tw:transition-all tw:group">
                <div class="tw:flex-1">
                    <h3 class="tw:text-3xl tw:font-black tw:text-white tw:mb-4">Capacitaciones</h3>
                    <p class="tw:text-orange-400 tw:text-sm tw:font-black tw:uppercase tw:tracking-[0.3em] tw:mb-12">Python y An&aacute;lisis</p>
                    <ul class="tw:space-y-6 tw:mb-16">
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Python con NumPy y Pandas</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Gesti&oacute;n de bases de datos</span>
                        </li>
                        <li class="tw:flex tw:items-start tw:gap-5 tw:text-white/80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span>Metodolog&iacute;as &aacute;giles reales</span>
                        </li>
                    </ul>
                </div>
                <div class="tw:pt-8">
                    <a href="https://cursos.datamaq.com.ar" class="tw:btn-outline tw:w-full tw:text-xl tw:font-black tw:py-6 tw:border-white/10 group-hover:tw:border-orange-400/50">
                        Ver plataforma de cursos
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>
