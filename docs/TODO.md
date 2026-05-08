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
- [x] Refactorizar a Arquitectura Hexagonal (Logger, ConfigProvider).
- [x] Crear esqueleto de `BotmanAdapter`.

## 🤖 Migración a BotMan (PHP)
- [ ] Instalar dependencias vía Composer (`botman/botman`).
- [ ] Implementar Webhook Controller (REST API).
- [ ] Desarrollar lógica de conversación (Conversations/Nodes).
- [ ] Integrar Widget de JS compatible con BotMan.

## 🚀 Continuous Delivery (CD)
- [ ] Configurar GitHub Actions CI (`ci.yml`).
- [ ] Definir secretos de despliegue en GitHub.
- [ ] Implementar el workflow de despliegue automático (`deploy.yml`).

## 📝 Documentación
- [x] Crear estructura base de documentación (`docs/`).
- [x] Separar dudas (`DISCOVERY.md`) de certezas (`SRS.md`).
- [x] Actualizar `README.md`.
