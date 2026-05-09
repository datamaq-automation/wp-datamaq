# TODO - Backlog de Tareas Pendientes

Este documento contiene las tareas planificadas para el mantenimiento y mejora del sitio DataMaq WordPress.
Para consultar las tareas ya finalizadas, ver [TODO.done.md](./TODO.done.md).

## 🧹 Limpieza Técnica y Refactorización
- [ ] **Dinamización de Configuración**: Eliminar valores hardcodeados en `datamaq-gateway.js` e inyectarlos vía `wp_localize_script`.
- [ ] **Seguridad de API**: Implementar validación de token/nonce para el endpoint de leads de WordPress.
- [ ] **Auditoría de Performance**: Verificar impacto del SDK de Chatwoot en la carga inicial y optimizar si es necesario (Lazy loading).

## 🧪 Testing y Calidad
- [ ] **Nuevos Tests Unitarios**: Implementar tests para `ChatWootLeadRepository` y `ChatWootApiClient`.
- [ ] **Tests de Integración**: Validar el flujo completo SPA -> WP -> Chatwoot en el entorno de pruebas.

## ✨ Mejoras de Funcionalidad
- [ ] **Página de Ajustes WP**: Implementar una interfaz en el admin de WordPress para cambiar las credenciales de Chatwoot sin tocar el `.env`.
- [ ] **Sincronización de Atributos**: Enviar metadatos adicionales del navegador (UTM parameters, URL actual) a Chatwoot durante la captura de leads.
- [ ] **Dashboard de Observabilidad**: Crear una pequeña vista en el admin de WP para previsualizar los últimos leads y su estado de sincronización.
