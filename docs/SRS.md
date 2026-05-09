# SRS - Software Requirements Specification

Especificación de requisitos para la réplica y mantenimiento del sitio DataMaq.

## 🎯 Objetivo General
Lograr la **Soberanía del Código** mediante la migración de la experiencia de usuario original (Vue SPA) hacia una arquitectura **WordPress Nativa** (PHP/Vanilla CSS-JS). El objetivo es eliminar la opacidad de los archivos compilados (`dist`) y permitir el mantenimiento directo y transparente dentro del ecosistema de WordPress, manteniendo la estética premium y la trazabilidad.

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
  - `ContentProviderInterface`: Abstrae la fuente de verdad del contenido de la UI.
  - `LoggerInterface`: Interfaz para observabilidad.
- **Implementaciones (Adapters):**
  - `ChatWootLeadRepository`: Sincronización con ChatWoot API.
  - `ChatwootProvider`: Inyección y control del widget oficial.
  - `WPConfigProvider`: Acceso a `.env` y configuración de WP.
  - `WPLogger`: Registro de eventos con prefijo `[Chatwoot]`.
  - `NativeThanksView`: Template PHP nativo con paridad 1:1.
  - `WhatsAppFabPartial`: Componente PHP/JS desacoplado de la SPA.
- **Configuración Dinámica (Client-Side):**
  - `DataMaqConfig`: Objeto de configuración obtenido dinámicamente vía API REST (`/datamaq/v1/config`) o inyectado en el DOM.
  - **Campos Expuestos**: `baseUrl`, `websiteToken`, `appSecret` y `traceId`.
- **Seguridad de API (Leads):**
  - **Estrategia Híbrida**: Shared Application Token (`X-DataMaq-Secret`) + CORS estricto + Rate Limiting por IP.
- **Observabilidad (Traceability):**
  - `TraceContext`: Almacén global de trazabilidad en PHP.
  - `X-DataMaq-Trace-ID`: Encabezado estándar para propagación de contexto desde el cliente.
  - **Correlación**: Los logs del servidor incluyen automáticamente el ID de seguimiento generado por el gateway JS.
- **Estrategia de Ajustes (Backend):**
  - **Persistencia**: Los ajustes en `wp_options` tienen prioridad sobre las constantes del `.env`.
- **Marketing & Tracking:**
  - **Atributos Capturados**: `utm_source`, `utm_medium`, `utm_campaign`, `landing_page`, `referrer`.

## 🎨 Estrategia de Migración de UI (Fase 4)
- **Renderizado del Servidor (SSR):** Toda la lógica de negocio y visualización debe resolverse en PHP antes de enviar el HTML al cliente.
- **Gestión de Variantes:** La resolución de variantes de la Home (`direct` vs `authority`) se delega a un `VariantResolver` en el backend, permitiendo optimización de SEO y eliminación de CLS.
- **Procesamiento de Contenido:** El `HomeContentProvider` es responsable de la lógica agregada (cálculo de *Trust Signals*, split de bullets con separador `·`) para que los templates reciban datos listos para mostrar.
- **Modularidad:** Uso obligatorio de Partials (`parts/home/`) para desacoplar las secciones de la Home (Hero, Services, Profile, etc.).
- **Mapeo de Iconos:** Implementación de un `IconMapper` centralizado para asignar clases de Bootstrap Icons basado en el contexto o palabras clave.

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
