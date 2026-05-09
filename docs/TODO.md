# TODO - Backlog de Tareas Pendientes

Este documento contiene las tareas planificadas para el mantenimiento y mejora del sitio DataMaq WordPress.
Para consultar las tareas ya finalizadas, ver [TODO.done.md](./TODO.done.md).

## 🧹 Limpieza Técnica y Refactorización
- [ ] **Auditoría de Performance**: Verificar impacto del SDK de Chatwoot en la carga inicial y optimizar si es necesario (Lazy loading).

## 🧪 Testing y Calidad
- [ ] **Nuevos Tests Unitarios**: Implementar tests para `ChatWootLeadRepository` y `ChatWootApiClient`.
- [ ] **Tests de Integración**: Validar el flujo completo SPA -> WP -> Chatwoot en el entorno de pruebas.

## ✨ Funcionalidades y Mejoras
- [ ] **Dashboard de Observabilidad**: Crear una pequeña vista en el admin de WP para previsualizar los últimos leads y su estado de sincronización.
