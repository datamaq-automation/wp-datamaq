# DataMaq Theme - Pendientes (TODO)

## Diseño y UX
- [ ] **Ajuste Mobile Paso 3 Contacto**: Refinar la alineación de las tarjetas de opción (WhatsApp/Email). Actualmente funcional pero requiere una revisión estética para que sea más convincente en pantallas pequeñas.
- [ ] **Validación de Teléfono**: Implementar una máscara de entrada para el campo de teléfono (ej: +54...).
- [ ] **Feedback de n8n**: Mostrar un mensaje de éxito más visual o una animación cuando el lead sea capturado correctamente.

## Arquitectura y Backend
- [x] **Configuración Dinámica n8n**: Implementada página de ajustes en WordPress (Ajustes -> n8n Integration) para gestionar la URL del webhook. ✅
- [x] **Refactor de Contacto (SOLID)**: Migrado a Clean Architecture con repositorio e inyección de dependencias. ✅
- [ ] **Refactor de FAQs**: Convertir el sistema de FAQs actual en un Custom Post Type (CPT) para que sea editable desde el admin de WordPress siguiendo la arquitectura DDD.
- [ ] **Refactor de Perfil**: Migrar la sección de perfil a la nueva estructura de repositorio y dominio.

## Documentación
- [x] **Contrato n8n**: Documentación técnica para el desarrollador backend creada en `docs/n8n-integration.md`. ✅

## Rendimiento
- [ ] **Optimización de Assets**: Revisar si podemos combinar `index.css` y `HomePage.css` para reducir peticiones HTTP ahora que la estructura está más estable.
