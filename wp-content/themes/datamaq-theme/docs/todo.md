# DataMaq Theme - Pendientes (TODO)

## Diseño y UX
- [ ] **Ajuste Mobile Paso 3 Contacto**: Refinar la alineación de las tarjetas de opción (WhatsApp/Email). Actualmente funcional pero requiere una revisión estética para que sea más convincente en pantallas pequeñas.
- [ ] **Validación de Teléfono**: Implementar una máscara de entrada para el campo de teléfono (ej: +54...).
- [ ] **Feedback de n8n**: Mostrar un mensaje de éxito más visual o una animación cuando el lead sea capturado correctamente.

## Arquitectura y Backend
- [x] **Configuración Dinámica n8n**: Implementada página de ajustes en WordPress (Ajustes -> n8n Integration) para gestionar la URL del webhook. ✅
- [x] **Refactor de Contacto (SOLID)**: Migrado a Clean Architecture con repositorio e inyección de dependencias. ✅
- [x] **Página de Gracias Premium**: Creada página de confirmación con diseño modular y standalone. ✅
- [x] **Integración BotMan y Sidecar**: Interceptor de SPA responsivo y motor de IA integrado nativamente en PHP. ✅
- [ ] **Refactor de FAQs**: Convertir el sistema de FAQs actual en un Custom Post Type (CPT).
- [ ] **Refactor de Perfil**: Migrar la sección de perfil a la nueva estructura de repositorio y dominio.

## Sincronización VPS (Manual)
- [ ] **Limpieza de Base de Datos**: Borrar páginas duplicadas de "Gracias" y "Contacto" en el Admin de la VPS.
- [ ] **Asignación de Plantillas**: Asegurar que las páginas `/contacto` y `/gracias` usen sus respectivas plantillas ("Contacto Técnico" y "Página de Gracias").
- [ ] **Limpieza de Caché**: Forzar vaciado de caché en el servidor si los cambios CSS/JS no se reflejan.

## Rendimiento
- [ ] **Optimización de Assets**: Combinar `index.css` y `HomePage.css`.
