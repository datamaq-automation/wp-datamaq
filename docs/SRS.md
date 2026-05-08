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

## 🏗️ Arquitectura de Software
- **Patrón:** Arquitectura Hexagonal (Ports & Adapters).
- **Abstracciones (Ports):**
  - `ChatProvider`: Abstrae el motor de comunicación.
  - `ConfigProvider`: Desacopla la lógica de negocio de la base de datos de opciones de WP.
  - `Logger`: Interfaz única para observabilidad y registro de errores.
- **Implementaciones (Adapters):**
  - `ChatwootAdapter`: Integración actual vía script.
  - `WPConfigProvider`: Acceso seguro a `get_option`.
  - `WPLogger`: Registro de eventos mediante `error_log`.

## 🛠️ Infraestructura Verificada
- **WP-CLI:** Disponible y funcional.
- **Validación Técnica:** El flujo de desarrollo cuenta con validaciones automáticas (L1-L4) mediante hooks de Git:
  - **L1:** Sintaxis PHP.
  - **L2:** WordPress Coding Standards (WPCS).
  - **L3:** Análisis Estático (PHPStan).
  - **L4:** Tests Unitarios (PHPUnit).

## 📜 Políticas y Estándares
- **Referencia:** Consultar `wp-content/themes/datamaq-theme/CONTRAST_POLICY.md` para estándares de color.
- **Versionado:** No trackear archivos de respaldo (`.bak`), archivos `.sql` ni configuraciones locales (`wp-config.php`).
