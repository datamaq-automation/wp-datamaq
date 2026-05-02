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

## Próximos Pasos Técnicos (Refactor & Fix)

### 1. Refactor de Arquitectura (SOLID / Clean Architecture)
- [ ] **Desacoplar Detección de Contexto**: Crear un `ContextService` para identificar páginas de producto sin depender de `is_product()`.
- [ ] **Carga Asíncrona de Assets**: Refactorizar `ShortcodeHandler` para usar el atributo `async` en la API de Google Maps.
- [ ] **Manejo de Dependencias**: Asegurar que `calculator.js` solo se ejecute cuando `google` esté definido (Race condition protection).

### 2. Observabilidad y Debugging
- [ ] **Logger Frontend**: Implementar un sistema de logs en consola (`DataMaq: info|error`) para monitorear la "teletransportación" en tiempo real.
- [ ] **Manejo de Errores de API**: Capturar fallos en Google Places y mostrarlos elegantemente en la UI (no solo en consola).

### 3. Integración WooCommerce
- [ ] Validar persistencia de metadatos en el carrito tras el "Teleport".
- [ ] Test de flujo completo: Calculadora -> Carrito -> Checkout.
- [ ] Implementar Hook de WooCommerce para inyectar precio dinámico al carrito.
- [ ] Configurar Navbar con botones destacados (Relevamiento / Automatización).
- [ ] Mover botón de WhatsApp al final del proceso de cotización.
