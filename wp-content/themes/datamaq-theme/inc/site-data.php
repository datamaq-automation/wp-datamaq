<?php
/**
 * DataMaq Site Data Repository
 * GOLD MASTER EDITION - 100% Content & Navigation Parity.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function get_datamaq_site_data() {
    $theme_url = get_stylesheet_directory_uri();
    
    return [
        'brand' => [
            'name' => 'DataMaq',
            'whatsapp' => 'https://wa.me/5491156297160',
            'email' => 'info@datamaq.com.ar',
            'base' => 'Gar&iacute;n (GBA Norte)'
        ],
        'hero' => [
            'eyebrow' => 'Captura autom&aacute;tica de datos operativos',
            'title' => 'Instalaci&oacute;n e integraci&oacute;n de equipos IoT para energ&iacute;a y producci&oacute;n',
            'subtitle' => 'Implementaci&oacute;n de soluciones para medir variables el&eacute;ctricas y operativas, integrarlas a sistemas existentes y dejar una base t&eacute;cnica usable para seguimiento, diagn&oacute;stico y capacitaci&oacute;n.',
            'ctaLabel' => 'Escribime por WhatsApp',
            'statusInfo' => 'Base operativa: Gar&iacute;n (GBA Norte). El alcance se define seg&uacute;n tablero, se&ntilde;ales disponibles, conectividad, sistema destino y objetivo operativo.',
            'trustChips' => [
                'Base operativa: Gar&iacute;n (GBA Norte). El alcance se define seg&uacute;n tablero, se&ntilde;ales disponibles, conectividad, sistema destino y objetivo operativo.',
                'Instalaci&oacute;n de equipos IoT para captura de datos',
                'Asesoramiento t&eacute;cnico para an&aacute;lisis de datos'
            ],
            'image' => $theme_url . '/assets/media/hero-energy.svg'
        ],
        'services' => [
            'eyebrow' => 'Servicios',
            'title' => 'Servicios t&eacute;cnicos sobre captura, integraci&oacute;n y uso de datos',
            'intro' => 'Servicios orientados a captura autom&aacute;tica de datos, integraci&oacute;n t&eacute;cnica y formaci&oacute;n aplicada sobre casos reales.',
            'cards' => [
                [
                    'id' => 'iot', 
                    'title' => 'Instalaci&oacute;n de equipos IoT para captura de datos', 
                    'description' => 'Relevamiento, montaje, configuraci&oacute;n y puesta en marcha de soluciones para medir variables el&eacute;ctricas y operativas en tableros, l&iacute;neas o puntos definidos.',
                    'subtitle' => 'Captura, comunicaci&oacute;n e integraci&oacute;n inicial',
                    'items' => [
                        'Medici&oacute;n de kWh, potencia, factor de potencia y distorsi&oacute;n arm&oacute;nica', 
                        'Captura de kilos, unidades, metros, velocidades o estados',
                        'Integraci&oacute;n inicial con Powermate o sistemas de terceros'
                    ],
                    'note' => 'Seg&uacute;n el caso, la implementaci&oacute;n puede apoyarse en Powermeter, Automate u otros equipos compatibles con la variable a capturar y el objetivo del proyecto.',
                    'cta' => ['label' => 'Consult&aacute; por instalaci&oacute;n', 'href' => '#contacto'],
                    'icon' => 'bi-bar-chart-line-fill'
                ],
                [
                    'id' => 'data', 
                    'title' => 'Asesoramiento t&eacute;cnico para an&aacute;lisis de datos', 
                    'description' => 'Acompa&ntilde;amiento para estructurar, interpretar y explotar datos ya capturados, con foco en seguimiento operativo, diagn&oacute;stico y criterio de decisi&oacute;n.',
                    'subtitle' => 'Datos, estructura y criterio t&eacute;cnico',
                    'items' => [
                        'An&aacute;lisis de consumo energ&eacute;tico y comportamiento operativo', 
                        'Ordenamiento de datos desde bases, planillas, APIs o sistemas existentes',
                        'Soporte para reportes, dashboards y automatizaciones de seguimiento'
                    ],
                    'note' => 'El asesoramiento puede incluir Python, bases de datos, APIs e integraciones cuando el caso requiere tratamiento, cruce o automatizaci&oacute;n de informaci&oacute;n.',
                    'cta' => ['label' => 'Consult&aacute; por asesoramiento', 'href' => '#contacto'],
                    'icon' => 'bi-bar-chart-line-fill'
                ],
                [
                    'id' => 'edu', 
                    'title' => 'Capacitaciones aplicadas', 
                    'description' => 'Formaci&oacute;n t&eacute;cnica orientada a equipos que necesiten trabajar con datos operativos, Python, bases de datos, APIs o integraciones sobre casos reales.',
                    'subtitle' => 'Capacitaci&oacute;n sobre casos concretos',
                    'items' => [
                        'Python aplicado con NumPy, pandas y Matplotlib', 
                        'Buenas pr&aacute;cticas para trabajar con bases de datos y APIs',
                        'Capacitaci&oacute;n adaptada al nivel t&eacute;cnico y al caso real del equipo'
                    ],
                    'note' => 'No se trata de formaci&oacute;n gen&eacute;rica. El enfoque se ajusta al problema, los datos disponibles y el nivel t&eacute;cnico de quienes participan.',
                    'cta' => ['label' => 'Consult&aacute; por capacitaci&oacute;n', 'href' => 'https://cursos.datamaq.com.ar'],
                    'icon' => 'bi-gear-wide-connected'
                ]
            ]
        ],
        'process' => [
            'eyebrow' => 'C&oacute;mo trabajamos',
            'title' => 'Flujo de implementaci&oacute;n t&eacute;cnica',
            'steps' => [
                [
                    'order' => '01',
                    'title' => 'Relevamiento y definici&oacute;n del caso',
                    'description' => 'Revisamos tablero, equipo, proceso, conectividad, variables a capturar y objetivo t&eacute;cnico para definir una implementaci&oacute;n razonable.'
                ],
                [
                    'order' => '02',
                    'title' => 'Instalaci&oacute;n y configuraci&oacute;n',
                    'description' => 'Montamos la soluci&oacute;n, configuramos comunicaci&oacute;n e integraci&oacute;n inicial y dejamos el esquema b&aacute;sico de captura funcionando.'
                ],
                [
                    'order' => '03',
                    'title' => 'Pruebas y validaci&oacute;n',
                    'description' => 'Verificamos lecturas, comunicaciones y condiciones m&iacute;nimas de funcionamiento antes del cierre t&eacute;cnico.'
                ],
                [
                    'order' => '04',
                    'title' => 'Cierre t&eacute;cnico y pr&oacute;ximos pasos',
                    'description' => 'Entregamos observaciones, pendientes y recomendaciones para estabilizar la captura y ordenar los datos.'
                ]
            ]
        ],
        'profile' => [
            'name' => 'Agustin Bustos',
            'role' => 'Sobre DataMaq',
            'lead' => 'DataMaq trabaja sobre captura autom&aacute;tica de datos operativos, con foco en energ&iacute;a el&eacute;ctrica, producci&oacute;n y variables cr&iacute;ticas de seguimiento.',
            'how_i_work' => 'El servicio combina relevamiento en campo, implementaci&oacute;n t&eacute;cnica, integraci&oacute;n inicial y acompa&ntilde;amiento para que los datos capturados puedan usarse con criterio en an&aacute;lisis, seguimiento o capacitaci&oacute;n.',
            'bullets' => [
                'Relevamiento en sitio y criterio de implementaci&oacute;n.',
                'Instalaci&oacute;n, integraci&oacute;n y puesta en marcha para captura autom&aacute;tica de datos.',
                'Asesoramiento y capacitaciones sobre Python, datos, bases de datos y APIs en contextos reales.'
            ],
            'photo' => $theme_url . '/assets/media/tecnico-a-cargo.webp',
            'whatsappLabel' => 'Escribime directo por WhatsApp'
        ],
        'faq' => [
            'eyebrow' => 'Ayuda',
            'title' => 'Preguntas frecuentes',
            'items' => [
                [
                    'question' => '&iquest;Qu&eacute; tipo de datos se pueden capturar?',
                    'answer' => 'Seg&uacute;n el caso, variables el&eacute;ctricas como kWh, potencia, factor de potencia y distorsi&oacute;n arm&oacute;nica, o variables operativas como kilos, unidades, metros, velocidades y estados.',
                    'open' => true
                ],
                [
                    'question' => '&iquest;Trabaj&aacute;s solo con energ&iacute;a el&eacute;ctrica?',
                    'answer' => 'No. La energ&iacute;a es una de las aplicaciones principales, pero tambi&eacute;n se pueden implementar soluciones para captura de datos de producci&oacute;n u otras variables operativas relevantes.'
                ],
                [
                    'question' => '&iquest;Us&aacute;s Powermeter y Automate?',
                    'answer' => 'S&iacute;. Seg&uacute;n el proyecto, la soluci&oacute;n puede apoyarse en Powermeter para medici&oacute;n el&eacute;ctrica y en Automate para captura e integraci&oacute;n de se&ntilde;ales y datos operativos.'
                ],
                [
                    'question' => '&iquest;Tambi&eacute;n brind&aacute;s asesoramiento sobre los datos capturados?',
                    'answer' => 'S&iacute;. El acompa&ntilde;amiento puede incluir estructuraci&oacute;n, an&aacute;lisis e interpretaci&oacute;n t&eacute;cnica de datos operativos y energ&eacute;ticos, seg&uacute;n la necesidad del caso.'
                ]
            ]
        ],
        'primaryContactForm' => [
            'title' => 'Inici&aacute; una consulta t&eacute;cnica',
            'subtitle' => 'Dejanos el contexto del caso y te respondemos con el siguiente paso.',
            'submitLabel' => 'Envi&aacute; tu consulta'
        ],
        'contactPage' => [
            'eyebrow' => 'Contacto',
            'title' => 'Inici&aacute; una consulta t&eacute;cnica',
            'subtitle' => 'Indic&aacute; qu&eacute; variable quer&eacute;s capturar y en qu&eacute; zona.',
            'supportTitle' => 'Canales disponibles',
            'placeholderName' => 'Ej: Agust&iacute;n',
            'placeholderMsg' => 'Describ&iacute; tu caso t&eacute;cnico...',
            'buttonLabel' => 'Continuar por WhatsApp'
        ]
    ];
}

