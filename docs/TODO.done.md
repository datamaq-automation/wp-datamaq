# Historial de Tareas Completadas (TODO.done)

Este documento registra todas las misiones y tareas finalizadas en el proyecto DataMaq WordPress.

## 🤖 Consolidación en Chatwoot (Mayo 2026)
- **Estado:** Finalizado con éxito.
- **Logros:**
    - [x] **Eliminación de Middleware (Sistemas Legados)**: Reducción de latencia y puntos de falla.
    - [x] **Remoción de Sistemas Legados**: Simplificación del stack de leads.
    - [x] **Remoción de Sistemas Legados**: Sustitución del motor de chat local por el SDK oficial de Chatwoot.
    - [x] **Implementación de `ChatWootLeadRepository`**: Sincronización robusta vía API REST con depuración detallada.
    - [x] **Refactorización de `LeadRestController`**: Puente seguro entre la SPA y Chatwoot.
    - [x] **Debug Gateway (index.html)**: Intercepción unificada de interacciones de la SPA para derivar a Chatwoot.
    - [x] **UI Sync**: Actualización de Footers y Heros para usar el nuevo sistema de comunicación.
    - [x] **Limpieza de Código Muerto**: Eliminadas referencias a Sistemas Legados, Sistemas Legados y Sistemas Legados en controladores y servicios PHP.
    - [x] **Purga de Assets JS**: `datamaq-chat.js` limpiado para evitar errores 404.
    - [x] **Auditoría de Dependencias**: Verificado que el `vendor` y `composer.json` están libres de paquetes legados.
    - [x] **Documentación Técnica**: Actualización de `README.md`, `SRS.md`, `AGENT.md` y creación de `CHATWOOT_CONTRACT.md`.

## 🏗️ Desarrollo Base del Tema
- [x] Implementar la sección "Process" en `front-page.php`.
- [x] Refactorizar a Arquitectura Hexagonal (Logger, ConfigProvider, HealthStatus).
- [x] Normalizar Observabilidad (Unificación de Interfaces de Log).

## 🧹 Limpieza y Optimización Inicial (Slimming)
- [x] Dejar de trackear el núcleo de WordPress.
- [x] Eliminar `learnpress` del índice de Git.
- [x] Eliminar archivos redundantes (`readme.html`, `license.txt`, etc.).
- [x] Consolidar la carpeta `media/` raíz.

## 🚀 Continuous Delivery (CD)
- [x] Configurar GitHub Actions CI (`ci.yml`).
- [x] Definir secretos y variables de entorno en GitHub.
- [x] Implementar el workflow de despliegue automático (`deploy.yml`).
