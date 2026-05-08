# SRS - Software Requirements Specification

Especificación de requisitos para la réplica y mantenimiento del sitio DataMaq.

## 🎯 Objetivo General
Replicar la narrativa y estética de la versión original en Vue dentro de una arquitectura nativa y optimizada de WordPress.

## 🎨 Requisitos de Diseño
- **Consistencia Visual:** Reutilizar la narrativa comercial: captura automática de datos, IoT, energía y producción.
- **Estética "Premium":**
  - Fondos degradados oscuros.
  - Header sticky translúcido.
  - Cards de servicios con acentos de color.
- **Accesibilidad:** Cumplimiento con la política de contraste definida en el tema.

## ⚙️ Requisitos Técnicos
- **Modularidad:** Todas las secciones de la home deben residir en `template-parts/`.
- **Performance:** Minimizar el uso de plugins pesados para el frontend; priorizar CSS vainilla.
- **Administración:** El contenido debe seguir siendo administrable desde Gutenberg/Bloques donde sea posible, sin romper la estructura modular de PHP.

## 📜 Políticas y Estándares
- **Referencia:** Consultar `wp-content/themes/datamaq-theme/CONTRAST_POLICY.md` para estándares de color.
- **Versionado:** No trackear archivos de respaldo (`.bak`), archivos `.sql` ni configuraciones locales (`wp-config.php`).
