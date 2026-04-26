# SRS - Software Requirements Specification: DataMaq V6

## 1. Introducci&oacute;n
Este documento define los requerimientos t&eacute;cnicos y funcionales para el entorno WordPress de DataMaq, basado en el concepto de **"V6 Absolute Parity"** (paridad total con la versi&oacute;n previa en Vue/Landing).

## 2. Requerimientos Funcionales
- **App-like Shell**: El sitio debe comportarse como una aplicaci&oacute;n, con un contenedor central (`.dm-app-shell`) de m&aacute;ximo 1440px y bordes redondeados.
- **Wizard de Contacto**: Formulario en 3 pasos (Identidad, Detalles, Preferencias) con integraci&oacute;n directa a WhatsApp.
- **Navegaci&oacute;n H&iacute;brida**: Header sticky en desktop y Dock persistente en m&oacute;vil.
- **Localizaci&oacute;n**: Todo el contenido debe estar en Espa&ntilde;ol Neutro/Argentino con soporte completo para UTF-8.

## 3. Requerimientos No Funcionales (Core Web Vitals)
- **Performance**: Carga de im&aacute;genes en formato WebP/SVG. Uso de fuentes variables para reducir peticiones.
- **Accesibilidad**: Cumplimiento b&aacute;sico de WCAG (Aria labels, contraste, jerarqu&iacute;a de encabezados).
- **Responsividad**: Dise&ntilde;o adaptable desde 320px hasta 4K.
- **Mantenibilidad**: Uso de Tailwind CSS para utilidades y BEM para componentes core del tema hijo.

## 4. Stack Tecnol&oacute;gico
- **Core**: WordPress 6.x + Blocksy Theme.
- **Stack Local**: Nginx (Proxy) -> Apache (Backend) -> PHP 8.3-FPM -> MySQL 8.0.
- **Frontend**: Tailwind CSS (via CDN o compilado), Inter Variable Font, Bootstrap Icons.

## 5. Criterios de Aceptaci&oacute;n (Parity)
- Visual id&eacute;ntico a la referencia `https://datamaq.com.ar`.
- Animaciones suaves de entrada (`shellEntry`, `stepIn`).
- Navegaci&oacute;n interna por anclas (`#servicios`, `#proceso`, etc.) funcional con scroll suave.
