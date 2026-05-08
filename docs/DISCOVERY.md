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

### Decisiones Arquitectónicas Consolidadas
- **Motor de Inteligencia:** Se eligió el **Árbol Clásico (Regex / Palabras clave)** en lugar de un LLM. Prioriza velocidad, control estricto del flujo comercial, previsibilidad total y cero costos recurrentes de API.
- **Flujos Conversacionales:** Se implementarán `Conversation` classes de BotMan para guiar al usuario paso a paso (ej. Soporte Técnico / Captación de Datos).
- **Captura de Leads (SuiteCRM Directo):** Se decidió descartar n8n en favor de una integración directa (Punto a Punto). El chatbot recogerá los datos e interactuará con la REST API v8 de SuiteCRM (`/Api/access_token` y `/api/v8/module/Leads`) usando OAuth2. Esto reduce infraestructura externa pero requiere manejar la lógica de autenticación y reintentos dentro de PHP.
- **Gestión de Contenido:** Se desarrollará posteriormente una interfaz de WordPress (Ajustes o CPT) para que el equipo comercial pueda gestionar el diccionario de intenciones y respuestas de manera autónoma.
