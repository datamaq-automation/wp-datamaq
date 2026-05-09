# 🔍 Discovery (Dudas Pendientes)

- ¿Qué estrategia de resiliencia usamos si Chatwoot falla: perder el lead, guardar en una tabla local de respaldo o reintentar mediante cron?
- ¿Qué feedback debe recibir el usuario en la SPA si la sincronización en el backend falla (éxito falso vs error real)?
- ¿Es necesario actualizar la política de privacidad/cookies de DataMaq al capturar UTMs y Referrers?
## 🏠 Migración de la Home (Soberanía del Código)

- **Gestión de Assets de Terceros (Trust Logos):** Los logos de empresas en el Hero están compilados en la SPA. Debemos localizarlos en el sistema de archivos y moverlos a `/wp-content/themes/datamaq-theme/assets/images/trust/`.
- **Estrategia de Cookies para Variantes:** ¿Qué duración debe tener la cookie de variante para asegurar consistencia sin afectar la privacidad?
