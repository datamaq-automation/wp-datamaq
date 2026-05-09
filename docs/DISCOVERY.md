# 🔍 Discovery (Dudas y Definiciones Pendientes)

Este documento centraliza exclusivamente las dudas arquitectónicas, técnicas o de negocio que necesitan ser resueltas por el equipo antes de proceder con el código.

## Transición a ChatWoot Directo (Fase 3)

### A. Interfaz de Usuario (Frontend)
¿Se inyectará el **Widget oficial de ChatWoot** (el script estándar en JS) o se mantendrá la **SPA de React/Vue interceptada** enviando peticiones silenciosas a la API de ChatWoot (como Contactos y Conversaciones)?

### B. Tratamiento del Lead (Entidades en ChatWoot)
Cuando se capture un lead desde un formulario, ¿qué se debe crear en ChatWoot?
- **Opción 1:** Crear un nuevo `Contact` (Contacto) y asignarle una nueva `Conversation` (Conversación) en un Inbox específico.
- **Opción 2:** Simplemente inyectar los datos como un mensaje suelto en la bandeja general.

### C. Automatización y Flujos Conversacionales
Dado que se elimina BotMan (motor de respuestas local PHP), ¿la lógica de saludos iniciales, recolección de datos y derivación será delegada **100% a las herramientas nativas de ChatWoot** (AgentBot, Dialogflow integrado)?

### D. Gestión de Credenciales
La API de ChatWoot requiere `Account ID`, `Inbox ID` y un `Access Token`. ¿Debemos exponer estos parámetros en una **página de opciones en el Admin de WordPress** o definirlos estáticamente en `wp-config.php` por seguridad?

### E. Flujo de Datos desde la SPA
Actualmente `LeadRestController` recibe los leads. ¿Debe ser este controlador el encargado de comunicarse vía cURL/Guzzle con la API de ChatWoot (recomendado para ocultar los tokens) o el frontend lo hará directamente?
