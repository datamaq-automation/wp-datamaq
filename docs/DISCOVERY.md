## 🏥 Auditoría de Infraestructura y Observabilidad (Mayo 2026)
- **Estado de Configuración:** Se detectó que el sitio estaba redirigiendo al instalador por falta de `wp-config.php`. Se recuperaron las credenciales reales (`datamaq_local`) desde la papelera del sistema.
- **Normalización de Loggers:** Se detectó duplicidad de interfaces de Logger. Se unificó todo bajo `LoggerInterface` en el namespace `Observability`.
- **Health Check DDD:** Se implementó el Value Object `HealthStatus` para profesionalizar el monitoreo de servicios externos (ej: Orchestrator).
- **Compatibilidad SPA:** Se registró el alias `/v1/health` para evitar hacks de interceptación en el frontend.

## 🤖 Integración de BotMan (Fase 2: Lógica Conversacional)
### Certezas Arquitectónicas
- **Aislamiento de Lógica:** Las reglas de conversación (intenciones/respuestas) están aisladas en `ChatbotService.php` (Domain Layer), abstraídas del framework BotMan.
- **Sidecar Pattern (SPA):** El widget Vanilla JS se inyectó en `index.html` secuestrando los enlaces de WhatsApp, unificando responsivamente el contacto sin alterar la SPA compilada.
- **Mecanismos Base:** Existen configuraciones operativas para Fallbacks (respuestas no mapeadas) y conectividad REST bidireccional lista con `/wp-json/datamaq/v1/chat`.

### Dudas Abiertas (Por Definir)
- **Flujos Conversacionales:** ¿Desarrollar conversaciones interactivas de múltiples pasos (BotMan Conversations) o mantener un formato QA (Pregunta-Respuesta directa)?
- **Captura de Leads (n8n):** ¿Debe el chatbot actuar como recolector de leads (solicitar email/teléfono) y disparar un webhook hacia n8n al final del flujo?
- **Motor de Inteligencia:** ¿Mantener un árbol cerrado mediante expresiones regulares o evolucionar hacia un motor de NLP / LLM (OpenAI/Gemini) integrado en `ChatbotService`?
- **Gestión de Contenido:** ¿Mantener las reglas hardcodeadas en PHP por performance o crear un CPT / Panel de Opciones en WordPress para que un administrador las edite?
