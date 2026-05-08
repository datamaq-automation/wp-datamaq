# TODO - Backlog y Tareas Pendientes

Listado de tareas para la optimización y finalización de la réplica Vue -> WordPress.

## 🧹 Limpieza y Optimización (Slimming)
- [ ] Dejar de trackear el núcleo de WordPress (`wp-admin`, `wp-includes`, archivos raíz).
- [ ] Eliminar `learnpress` del índice de Git (mantener archivos físicos).
- [ ] Eliminar archivos redundantes: `readme.html`, `license.txt`, `wp-config-sample.php`.
- [ ] Eliminar archivos `.bak` en `wp-content/mu-plugins/`.
- [ ] Consolidar la carpeta `media/` raíz dentro del tema o `uploads/`.

## 🏗️ Desarrollo del Tema (`datamaq-theme`)
- [ ] Implementar la sección "Process" en `front-page.php` (actualmente vacía).
- [ ] Revisar y optimizar `template-parts/content-hero.php`.
- [ ] Validar la visualización del "Dock" móvil inferior.

## 📝 Documentación
- [x] Crear estructura base de documentación (`docs/`).
- [x] Unificar `README.md`.
- [ ] Documentar el proceso de despliegue (Deploy Workflow).
