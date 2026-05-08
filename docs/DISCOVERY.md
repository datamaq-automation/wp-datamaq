## 🏥 Auditoría de Infraestructura y Observabilidad (Mayo 2026)
- **Estado de Configuración:** Se detectó que el sitio estaba redirigiendo al instalador por falta de `wp-config.php`. Se recuperaron las credenciales reales (`datamaq_local`) desde la papelera del sistema.
- **Normalización de Loggers:** Se detectó duplicidad de interfaces de Logger. Se unificó todo bajo `LoggerInterface` en el namespace `Observability`.
- **Health Check DDD:** Se implementó el Value Object `HealthStatus` para profesionalizar el monitoreo de servicios externos (ej: Orchestrator).
- **Compatibilidad SPA:** Se registró el alias `/v1/health` para evitar hacks de interceptación en el frontend.

## 🤖 Integración de BotMan (Fase 2: Frontend e Inteligencia)
- **Tecnología del Widget:** ¿Componente en React (requiere build) o Vanilla JS (ligero)?
- **Fuente de Conocimiento:** ¿Respuestas estáticas (código), dinámicas (Custom Post Type en WordPress) o vía IA Externa (Gemini)?
- **Persistencia de Sesión:** ¿Implementar adaptador para WordPress Transients para evitar el uso de archivos en el VPS?
- **Integración con WooCommerce:** ¿El bot debe mostrar precios y botones de compra directos de los cursos?
