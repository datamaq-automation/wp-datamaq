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

## 🤖 Migración a ChatWoot Directo (Volantazo)
- [x] Definir certezas arquitectónicas (Frontend, Entidades, Automatización, Credenciales).
- [x] Eliminar dependencias de `botman/botman` vía Composer.
- [x] Eliminar clases y servicios relacionados a BotMan (`ChatbotService`, `BotmanAdapter`).
- [x] Eliminar clases y servicios relacionados a SuiteCRM (`SuiteCrmService`, `SuiteCrmLeadRepository`).
- [x] Eliminar archivos de integración de n8n.
- [ ] Implementar `ChatWootLeadRepository` (o similar) para enviar datos a la API de ChatWoot.
- [ ] Adaptar o remover el "Debug Gateway" de interceptación SPA según la decisión sobre el widget frontend.
- [x] Refactorizar `LeadRestController` para utilizar el nuevo proveedor de ChatWoot.
- [ ] Eliminar tests de SuiteCRM, BotMan y n8n, y crear nuevos para ChatWoot.

## 🚀 Continuous Delivery (CD)
- [x] Configurar GitHub Actions CI (`ci.yml`).
- [x] Definir secretos de despliegue en GitHub (SSH_KEY, HOST, USER).
- [x] Implementar el workflow de despliegue automático (`deploy.yml`).

## 📝 Documentación
- [x] Crear estructura base de documentación (`docs/`).
- [x] Separar dudas (`DISCOVERY.md`) de certezas (`SRS.md`).
- [x] Actualizar `README.md`.
