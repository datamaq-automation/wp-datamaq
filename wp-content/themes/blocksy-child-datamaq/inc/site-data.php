<?php
/**
 * DataMaq Site Data Repository
 * Source of truth for all frontend strings and content.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function get_datamaq_site_data() {
    return [
        'hero' => [
            'badge' => 'Captura automática de datos operativos',
            'title' => 'Instalación e integración de equipos IoT para energía y producción',
            'subtitle' => 'Implementación de soluciones para medir variables eléctricas y operativas, integrarlas a sistemas existentes y dejar una base técnica usable para seguimiento, diagnóstico y capacitación.',
            'primaryCta' => ['label' => 'Escribime por WhatsApp', 'href' => 'https://wa.me/5491156297160'],
            'secondaryCta' => ['label' => 'Ver alcance técnico', 'href' => '#servicios'],
            'image' => get_stylesheet_directory_uri() . '/assets/media/hero-energy.svg'
        ],
        'services' => [
            'title' => 'Servicios técnicos sobre captura, integración y uso de datos',
            'intro' => 'Servicios orientados a captura automática de datos, integración técnica y formación aplicada sobre casos reales.',
            'cards' => [
                [
                    'id' => 'iot-installation', 
                    'title' => 'Instalación de equipos IoT', 
                    'description' => 'Relevamiento, montaje y puesta en marcha.', 
                    'subtitle' => 'Captura e integración inicial', 
                    'icon' => 'bi-tools', 
                    'items' => ['Medición de kWh y potencia', 'Captura de kilos y unidades', 'Integración con Powermate'], 
                    'cta' => ['label' => 'Consultá por instalación', 'href' => '#contacto']
                ],
                [
                    'id' => 'data-advisory', 
                    'title' => 'Asesoramiento técnico', 
                    'description' => 'Acompañamiento para estructurar y explotar datos.', 
                    'subtitle' => 'Datos y criterio técnico', 
                    'icon' => 'bi-graph-up-arrow', 
                    'items' => ['Análisis de comportamiento', 'Ordenamiento de datos', 'Soporte para reportes'], 
                    'cta' => ['label' => 'Consultá por asesoramiento', 'href' => '#contacto']
                ],
                [
                    'id' => 'training', 
                    'title' => 'Capacitaciones aplicadas', 
                    'description' => 'Formación técnica sobre casos reales.', 
                    'subtitle' => 'Python y APIs en contexto', 
                    'icon' => 'bi-mortarboard-fill', 
                    'items' => ['Python aplicado', 'Bases de datos y APIs', 'Casos reales del equipo'], 
                    'cta' => ['label' => 'Consultá por capacitación', 'href' => 'https://cursos.datamaq.com.ar']
                ]
            ]
        ],
        'profile' => [
            'name' => 'Agustin Bustos', 
            'role' => 'Técnico a cargo',
            'lead' => 'DataMaq trabaja sobre captura automática de datos operativos, con foco en energía eléctrica y producción.',
            'detail' => 'El servicio combina relevamiento en campo, implementación técnica e integración para seguimiento y diagnóstico.',
            'bullets' => ['Relevamiento en sitio.', 'Instalación y puesta en marcha.', 'Asesoramiento sobre datos.'],
            'photo' => get_stylesheet_directory_uri() . '/assets/media/tecnico-a-cargo.webp'
        ],
        'process' => [
            'title' => 'Cómo trabajamos',
            'steps' => [
                ['order' => 1, 'title' => 'Relevamiento', 'desc' => 'Definimos el caso y objetivo técnico.'],
                ['order' => 2, 'title' => 'Instalación', 'desc' => 'Montaje y configuración inicial.'],
                ['order' => 3, 'title' => 'Validación', 'desc' => 'Verificamos lecturas y comunicación.'],
                ['order' => 4, 'title' => 'Cierre', 'desc' => 'Entregamos el kit y próximos pasos.']
            ]
        ],
        'faq' => [
            'title' => 'Preguntas frecuentes',
            'items' => [
                ['q' => '¿Qué datos se pueden capturar?', 'a' => 'kWh, potencia, kilos, unidades, metros, estados operativos y variables críticas.'],
                ['q' => '¿Trabajás solo con energía eléctrica?', 'a' => 'No. La energía es clave, pero capturamos cualquier variable industrial que pueda medirse.'],
                ['q' => '¿Usás Powermeter y Automate?', 'a' => 'Sí, son los equipos base para la mayoría de las integraciones por su robustez y precisión.'],
                ['q' => '¿Las capacitaciones son grabadas?', 'a' => 'No. Son sesiones aplicadas sobre tus propios datos y casos reales para que el aprendizaje sea inmediato.']
            ]
        ],
        'contact' => [
            'title' => 'Iniciá una consulta técnica',
            'subtitle' => 'Dejanos el contexto del caso y te respondemos con el siguiente paso.',
            'submitLabel' => 'Enviá tu consulta'
        ]
    ];
}
