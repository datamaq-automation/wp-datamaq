# TODO - Backlog y Tareas Pendientes

Listado de tareas para la optimización y finalización de la réplica Vue -> WordPress.

## 🧹 Limpieza y Optimización (Slimming)
- [x] Dejar de trackear el núcleo de WordPress (`wp-admin`, `wp-includes`, archivos raíz).
- [x] Eliminar `learnpress` del índice de Git (mantener archivos físicos).
- [x] Eliminar archivos redundantes: `readme.html`, `license.txt`, `wp-config-sample.php`.
- [x] Eliminar archivos `.bak` en `wp-content/mu-plugins/`.
- [x] Consolidar la carpeta `media/` raíz dentro del tema o `uploads/`.

## 🏗️ Desarrollo del Tema (`datamaq-theme`)
- [x] Implementar la sección "Process" en `front-page.php`.
- [x] Refactorizar a Arquitectura Hexagonal (Logger, ConfigProvider, HealthStatus).
- [x] Normalizar Observabilidad (Unificación de Interfaces de Log).

## 🤖 Migración a BotMan (PHP)
- [x] Instalar dependencias vía Composer (`botman/botman`).
- [x] Implementar Webhook Controller (REST API: `/chat`).
- [ ] Desarrollar clase `LeadCaptureConversation` para calificar contactos.
- [ ] Desarrollar clase `SupportConversation` para soporte técnico guiado.
- [ ] Desarrollar servicio HTTP Client (`SuiteCrmService`) para la REST API v8.
- [ ] Implementar autenticación OAuth2 (obtención y renovación de tokens).
- [ ] Mapear y enviar payload JSON de LeadCaptureConversation hacia `/api/v8/module/Leads`.
- [ ] Desarrollar Panel de Ajustes / CPT en WordPress para editar reglas de Regex sin tocar código.
- [x] Integrar Widget de JS compatible con BotMan.

## 🚀 Continuous Delivery (CD)
- [x] Configurar GitHub Actions CI (`ci.yml`).
- [x] Definir secretos de despliegue en GitHub (SSH_KEY, HOST, USER).
- [x] Implementar el workflow de despliegue automático (`deploy.yml`).

## 📝 Documentación
- [x] Crear estructura base de documentación (`docs/`).
- [x] Separar dudas (`DISCOVERY.md`) de certezas (`SRS.md`).
- [x] Actualizar `README.md`.
