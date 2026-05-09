# TODO - Backlog de Tareas Pendientes

Este documento contiene las tareas planificadas para el mantenimiento y mejora del sitio DataMaq WordPress.
Para consultar las tareas ya finalizadas, ver [TODO.done.md](./TODO.done.md).

## 🧹 Limpieza Técnica (Próximos Pasos)
- [ ] **Purga de Dependencias**: Eliminar `botman/botman` y `suitecrm/php-sdk` (si existe) de `composer.json` y ejecutar `composer update`.
- [ ] **Limpieza de Assets**: Eliminar el código muerto de BotMan en `assets/js/datamaq-chat.js` o eliminar el archivo si ya no tiene uso residual.
- [ ] **Remoción de Archivos Legados**: Eliminar adaptadores e interfaces de SuiteCRM y BotMan en `src/Infrastructure` y `src/Domain` que ya no se utilicen.

## 🧪 Testing y Calidad
- [ ] **Nuevos Tests Unitarios**: Implementar tests para `ChatWootLeadRepository` y `ChatwootProvider`.
- [ ] **Auditoría de Performance**: Verificar impacto del SDK de Chatwoot en la carga inicial y optimizar si es necesario (Lazy loading).

## ✨ Mejoras de Funcionalidad
- [ ] **Página de Ajustes WP**: Implementar una interfaz en el admin de WordPress para cambiar las credenciales de Chatwoot sin tocar el `.env`.
- [ ] **Sincronización de Atributos**: Enviar metadatos adicionales del navegador (UTM parameters, URL actual) a Chatwoot durante la captura de leads.

## 🚀 Despliegue
- [ ] Realizar un despliegue de prueba completo tras la purga de dependencias para verificar integridad en producción.
