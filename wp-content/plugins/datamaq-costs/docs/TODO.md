# 📋 TODO: Datamaq Costs Infrastructure

## Alta Prioridad (Infraestructura)
- [x] Refactorizar a Clean Architecture (Domain, Application, Infrastructure).
- [x] Implementar Value Objects (`Money`, `GoogleApiKey`).
- [x] Resolver errores 500 en `admin-ajax.php`.
- [x] Corregir Mixed Content y bucles de redirección SSL.

## UI/UX Panel de Administración
- [x] Crear layout de tarjetas (Cards) para ajustes.
- [x] Implementar Toggle de visibilidad para API Key.
- [x] Implementar "Modo Edición" con interruptor de seguridad.
- [x] Mantener "Probar Conexión" siempre visible.
- [x] Implementar Toggle de Chatwoot (External Services).

## Refactor de Arquitectura (SOLID / Clean Architecture)
- [x] **Desacoplar Detección de Contexto**: `WordPressContextService` implementado.
- [x] **Carga Asíncrona (Performance)**: `AssetManager` inyecta `async`, `defer` y `loading=async` (Resolución de Warnings de Google).
- [x] **Manejo de Dependencias**: Protección de Race condition implementada en `calculator.js`.

## Observabilidad y Debugging
- [x] **Logger Frontend**: `DMLog` implementado para monitoreo de teletransportación y AJAX.
- [x] **Debug Mode**: Botón provisorio para simular cálculos exitosos y verificar integración.

## Integración WooCommerce
- [x] **Flujo Unificado**: Eliminación de botón redundante y habilitación dinámica del botón nativo de WooCommerce.
- [x] **Persistencia Robusta**: Inyección de `dm_custom_price` y `dm_custom_address` vía `cart_item_data`.
- [x] **Vendido Individualmente**: Automatización vía WP-CLI / Ajustes para producto ID 251.
- [x] **Navegación UX**: Scroll automático hacia el botón de compra tras cálculo exitoso.

## Próximos Pasos
- [ ] Configurar Navbar con botones destacados (Relevamiento / Automatización).
- [ ] Mover botón de WhatsApp al final del proceso de cotización.
- [ ] Implementar detección automática vía GPS (Browser Geolocation).
