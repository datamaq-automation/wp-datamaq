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
  - `LeadRepositoryInterface`: Abstrae el destino de los leads.
  - `ChatProvider`: Abstrae el motor de comunicación frontend.
  - `ConfigProvider`: Desacopla la lógica de negocio.
  - `LoggerInterface`: Interfaz para observabilidad.
- **Implementaciones (Adapters):**
  - `ChatWootLeadRepository`: Sincronización con ChatWoot API.
  - `ChatwootProvider`: Inyección y control del widget oficial.
  - `WPConfigProvider`: Acceso a `.env` y configuración de WP.
  - `WPLogger`: Registro de eventos con prefijo `[Chatwoot]`.
- **Observabilidad (Traceability):**
-   - `TraceContext`: Almacén global de trazabilidad en PHP.
-   - `X-DataMaq-Trace-ID`: Encabezado estándar para propagación de contexto desde el cliente.
-   - **Correlación**: Los logs del servidor incluyen automáticamente el ID de seguimiento generado por el gateway JS.

## 🛠️ Infraestructura Verificada
- **WP-CLI:** Disponible y funcional.
- **Validación Técnica (Local-First):** Para optimizar recursos y minutos de CI, todas las validaciones (L1-L4) se ejecutan localmente mediante hooks de Git antes del push. El pipeline de GitHub confía en esta validación previa para proceder directamente al despliegue.
  - **L1:** Sintaxis PHP.
  - **L2:** WordPress Coding Standards (WPCS).
  - **L3:** Análisis Estático (PHPStan).
  - **L4:** Tests Unitarios (PHPUnit).

## 📜 Políticas y Estándares
- **Referencia:** Consultar `wp-content/themes/datamaq-theme/CONTRAST_POLICY.md` para estándares de color.
- **Versionado:** No trackear archivos de respaldo (`.bak`), archivos `.sql` ni configuraciones locales (`wp-config.php`).
