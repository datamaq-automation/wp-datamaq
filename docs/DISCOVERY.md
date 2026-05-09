# 🔍 Discovery (Dudas y Definiciones Pendientes)

Este documento centraliza exclusivamente las dudas arquitectónicas, técnicas o de negocio que necesitan ser resueltas antes de proceder con las tareas del backlog (`TODO.md`).

---

## 📌 Dudas sobre el Backlog Actual

### 1. Dinamización de Configuración (Frontend)
- **Seguridad**: ¿Qué campos del `.env` se consideran seguros para exponer al cliente? Proponemos limitar la exposición al `CHATWOOT_BASE_URL` y `CHATWOOT_WEBSITE_TOKEN`. El `ACCESS_TOKEN` de administrador debe permanecer exclusivamente en el servidor.
- **Namespace**: ¿Qué nombre de objeto global prefieres para la configuración en JS? (Sugerencia: `window.DataMaqConfig`).

### 2. Seguridad de la API REST
- **Validación**: Para el endpoint de leads, ¿preferimos usar el sistema de **Nonces** nativo de WordPress o implementar un **Token de Aplicación** estático para la SPA? 
    - *Nota*: Los Nonces caducan y pueden dar problemas en SPAs cacheadas.

### 3. Página de Ajustes en WordPress
- **Persistencia**: ¿Los ajustes deben guardarse en la tabla `wp_options` (prioridad sobre el `.env`) o prefieres que la interfaz intente escribir directamente en el archivo `.env` del servidor? (Sugerencia: `wp_options` por seguridad y simplicidad).

### 4. Sincronización de Atributos (Marketing)
- **UTMs**: Además de los parámetros estándar (`source`, `medium`, `campaign`), ¿hay algún dato específico de la sesión del usuario que desees capturar y enviar a Chatwoot (ej: URL de referencia, tiempo de permanencia)?

### 5. Testing de Integración
- **Entorno**: ¿Disponemos de un entorno de staging/QA idéntico a producción o las pruebas de integración deben realizarse directamente en `datamaq.local` con mocks de la API de Chatwoot?
