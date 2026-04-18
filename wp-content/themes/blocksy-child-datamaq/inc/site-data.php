<?php
/**
 * DataMaq Site Data Repository
 * Source of truth for all frontend strings and content.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function get_datamaq_site_data() {
    $theme_url = get_stylesheet_directory_uri();
    
    return [
        'brand' => [
            'name' => 'DataMaq',
            'whatsapp' => 'https://wa.me/5491156297160',
            'email' => 'info@datamaq.com.ar',
            'base' => 'Garín (GBA Norte)'
        ],
        'hero' => [
            'badge' => 'Captura automática de datos operativos',
            'title' => 'Instalación e integración de equipos IoT para energía y producción',
            'subtitle' => 'Implementación de soluciones para medir variables eléctricas y operativas, integrarlas a sistemas existentes y dejar una base técnica usable para seguimiento, diagnóstico y capacitación.',
            'primaryCta' => ['label' => 'Escribime por WhatsApp', 'href' => 'https://wa.me/5491156297160'],
            'secondaryCta' => ['label' => 'Ver alcance técnico', 'href' => '#servicios'],
            'image' => $theme_url . '/assets/media/hero-energy.svg'
        ],
        'services' => [
            'title' => 'Servicios técnicos sobre captura, integración y uso de datos',
            'cards' => [
                [
                    'id' => 'iot-installation', 
                    'title' => 'Instalación de equipos IoT para captura de datos', 
                    'subtitle' => 'Captura, comunicación e integración inicial', 
                    'items' => ['Medición de kWh, potencia, factor de potencia y armónicas', 'Captura de kilos, unidades, metros, velocidades o estados', 'Integración inicial con Powermate o sistemas de terceros'], 
                    'cta' => ['label' => 'Consultá por instalación', 'href' => '#contacto']
                ],
                [
                    'id' => 'data-advisory', 
                    'title' => 'Asesoramiento técnico para análisis de datos', 
                    'subtitle' => 'Datos, estructura y criterio técnico', 
                    'items' => ['Análisis de consumo energético y comportamiento operativo', 'Ordenamiento de datos desde bases, planillas, APIs o sistemas existentes', 'Soporte para reportes, dashboards y automatizaciones de seguimiento'], 
                    'cta' => ['label' => 'Consultá por asesoramiento', 'href' => '#contacto']
                ],
                [
                    'id' => 'training', 
                    'title' => 'Capacitaciones aplicadas', 
                    'subtitle' => 'Capacitación sobre casos concretos', 
                    'items' => ['Python aplicado con NumPy, pandas y Matplotlib', 'Buenas prácticas para trabajar con bases de datos y APIs', 'Capacitación adaptada al nivel técnico y al caso real del equipo'], 
                    'cta' => ['label' => 'Consultá por capacitación', 'href' => 'https://cursos.datamaq.com.ar']
                ]
            ]
        ],
        'profile' => [
            'name' => 'Agustin Bustos', 
            'role' => 'Técnico a cargo',
            'lead' => 'DataMaq trabaja sobre captura automática de datos operativos, con foco en energía eléctrica y producción.',
            'detail' => 'El servicio combina relevamiento en campo, implementación técnica e integración para seguimiento y diagnóstico.',
            'photo' => $theme_url . '/assets/media/tecnico-a-cargo.webp'
        ],
        'process' => [
            'title' => 'Cómo trabajamos',
            'steps' => [
                ['order' => 1, 'title' => 'Relevamiento y definición del caso', 'desc' => 'Revisamos tablero, equipo, proceso, conectividad y variables a capturar.'],
                ['order' => 2, 'title' => 'Instalación y configuración', 'desc' => 'Montamos la solución y configuramos la comunicación e integración inicial.'],
                ['order' => 3, 'title' => 'Pruebas y validación', 'desc' => 'Verificamos lecturas, comunicaciones y condiciones mínimas de funcionamiento.'],
                ['order' => 4, 'title' => 'Cierre técnico y próximos pasos', 'desc' => 'Entregamos observaciones y recomendaciones para estabilizar la captura.']
            ]
        ],
        'faq' => [
            'title' => 'Preguntas frecuentes',
            'items' => [
                ['q' => '¿Qué tipo de datos se pueden capturar?', 'a' => 'Variables eléctricas (kWh, potencia) u operativas (kilos, unidades, metros, estados).'],
                ['q' => '¿Trabajás solo con energía eléctrica?', 'a' => 'No. También implementamos soluciones para datos de producción y procesos industriales.'],
                ['q' => '¿Usás Powermeter y Automate?', 'a' => 'Sí. Según el proyecto, usamos Powermeter para eléctrica y Automate para señales operativas.'],
                ['q' => '¿Qué necesitás para evaluar el caso?', 'a' => 'Zona, fotos del tablero, variables a capturar, conectividad y sistema de destino.']
            ]
        ],
        'contactPage' => [
            'eyebrow' => 'Contacto',
            'title' => 'Iniciá una consulta técnica',
            'subtitle' => 'Indicá qué variable querés capturar, desde qué equipo o proceso, con qué objetivo y en qué zona.',
            'supportTitle' => 'Canales disponibles',
            'supportItems' => [
                'Formulario principal para consultas técnicas y comerciales.',
                'WhatsApp directo para coordinación rápida cuando esté habilitado.'
            ],
            'introLinks' => [
                ['label' => 'Solución', 'href' => home_url('#servicios')],
                ['label' => 'Perfil técnico', 'href' => home_url('#perfil')],
                ['label' => 'FAQ', 'href' => home_url('#faq')]
            ]
        ],
        'escobarLanding' => [
            'eyebrow' => 'Captura automática',
            'headline' => 'Medición de Consumo y Eficiencia Industrial',
            'lead' => 'Implementamos sistemas de captura automática para monitorear variables críticas en tiempo real.',
            'summaryTitle' => 'Alcance del servicio',
            'summary' => [
                'Captura de kWh, potencia y factor de potencia.',
                'Vinculación con Powermate o dashboards propios.',
                'Datos ordenados para seguimiento operativo y diagnóstico.'
            ],
            'includesTitle' => 'Incluye',
            'includes' => [
                'Relevamiento inicial y checklist técnico.',
                'Instalación y configuración básica de la solución.',
                'Integración inicial si el alcance lo contempla.',
                'Transferencia técnica inicial o capacitación breve.'
            ],
            'processTitle' => 'Proceso de Trabajo',
            'processSteps' => [
                'Definición del caso. Revisamos tablero, equipo y conectividad.',
                'Implementación. Montaje y configuración de la comunicación.',
                'Validación. Verificación de lecturas antes del cierre técnico.'
            ],
            'faqs' => [
                ['question' => '¿Qué necesito para empezar?', 'answer' => 'Fotos del tablero principal y definir qué variables quieres monitorear.'],
                ['question' => '¿La instalación requiere corte de energía?', 'answer' => 'Depende del tipo de sensores, pero priorizamos métodos no invasivos (TCs abiertos).']
            ]
        ]
    ];
}
