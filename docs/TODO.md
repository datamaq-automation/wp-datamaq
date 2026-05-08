# TODO - Backlog y Tareas Pendientes

Listado de tareas para la optimización y finalización de la réplica Vue -> WordPress.

## 🧹 Limpieza y Optimización (Slimming)
- [x] Dejar de trackear el núcleo de WordPress (`wp-admin`, `wp-includes`, archivos raíz).
- [x] Eliminar `learnpress` del índice de Git (mantener archivos físicos).
- [x] Eliminar archivos redundantes: `readme.html`, `license.txt`, `wp-config-sample.php`.
- [x] Eliminar archivos `.bak` en `wp-content/mu-plugins/`.
- [x] Consolidar la carpeta `media/` raíz dentro del tema o `uploads/`.

## 🏗️ Desarrollo del Tema (`datamaq-theme`)
- [x] Implementar la sección "Process" en `front-page.php` (actualmente vacía).
- [x] Revisar y optimizar `template-parts/content-hero.php`.
- [x] Validar la visualización del "Dock" móvil inferior.

## 📝 Documentación
- [x] Crear estructura base de documentación (`docs/`).
- [x] Unificar `README.md`.
- [x] Documentar el proceso de despliegue (Deploy Workflow).
- [x] Configurar Git Hook local para CI (Nivel 3: PHPStan).
- [ ] Implementar el workflow de GitHub Actions (`.github/workflows/deploy.yml`).
