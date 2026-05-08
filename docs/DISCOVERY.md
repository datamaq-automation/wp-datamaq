# DISCOVERY - Hallazgos y Estado del Sistema

Este documento registra las certezas técnicas verificadas directamente en el codebase actual.

## 🏢 Entorno y Configuración
- **Site Name:** DataMaq.
- **Active Theme:** `datamaq-theme` (Versión 1.0.0).
- **Home Page:** Asignada a la página con ID **205** (slug: `datamaq-home`).
- **Template de Portada:** El tema cuenta con un archivo `front-page.php` funcional y modular.
- **Arquitectura del Tema:** Basada en fragmentos (`template-parts/`), facilitando el mantenimiento de secciones individuales (hero, profile, services, faq, contact).

## 🛠️ Infraestructura
- **WP-CLI:** Disponible y funcional en el entorno.
- **Mu-plugins:** Se detectaron 8 plugins imprescindibles (ajustes de español, redirecciones legacy, y personalizaciones de LearnPress).
- **Plugins Críticos:** 
  - `datamaq-costs` (Personalizado).
  - `learnpress` (Sistema de cursos).
  - `woocommerce` (E-commerce).
  - `wordfence` (Seguridad).

## 📊 Auditoría de Repositorio (May 2026)
- **Estado:** "Fat Repository".
- **Tracking:** Actualmente se está trackeando el núcleo de WordPress y el plugin LearnPress, lo cual es redundante.
- **Riesgos:** Archivos `.bak` detectados en `mu-plugins` siendo seguidos por Git.
- **Oportunidad:** Reducir el tamaño del repositorio en un ~90% mediante la exclusión del core y plugins de terceros.
