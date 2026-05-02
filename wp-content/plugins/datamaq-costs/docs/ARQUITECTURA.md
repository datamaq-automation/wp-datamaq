# Arquitectura del Plugin - Datamaq Costs

Este plugin sigue los principios de **Arquitectura Limpia (Clean Architecture)** y **Diseño Orientado al Dominio (DDD)** para asegurar mantenibilidad y escalabilidad.

## Capas del Sistema (`src/`)

### 1. Domain (Dominio)
*   **Propósito:** Lógica de negocio pura y objetos de valor.
*   **Componentes Clave:** `CostSettings`, `GoogleApiKey`, `Money`.
*   *Independencia:* No conoce WordPress ni APIs externas.

### 2. Application (Aplicación)
*   **Propósito:** Orquestación de casos de uso.
*   **Componentes Clave:** `CostCalculator`.

### 3. Infrastructure (Infraestructura)
*   **External:** Clientes de terceros (`GoogleMapsClient`).
*   **Persistence:** Implementaciones de WordPress (`WordPressSettingsRepository`, `WordPressContextService`).
*   **UI/Admin:** Gestión de ajustes con seguridad ("Modo Edición") y carga condicional de servicios externos (Chatwoot).
*   **UI/Frontend:** Manejo de shortcodes y activos.
*   **UI/WooCommerce:** Ganchos del carrito (`CartHandler`) para inyección de precios dinámicos.

## Mecanismos Especiales

### Teletransportación (Vue.js Bridge)
Dado que el tema utiliza Vue.js y renderiza dinámicamente el DOM, el plugin inyecta un contenedor oculto en el footer y utiliza un `MutationObserver` + `XPath` para "teletransportar" la calculadora al lugar exacto del shortcode en cuanto este aparece en el DOM.

### Integración de Compra Unificada
En lugar de un botón de compra propio, el plugin actúa como un **Portero (Guard)** del botón nativo de WooCommerce:
1. Bloquea el botón `.single_add_to_cart_button` al cargar.
2. Inyecta campos ocultos (`dm_calculated_price`, `dm_calculated_address`) al formulario.
3. Habilita el botón solo tras un cálculo exitoso de la API de Google Maps.
4. Sincroniza los metadatos con el carrito usando `woocommerce_add_cart_item_data`.

## Rendimiento y SEO
- **Google Maps API**: Se carga con `loading=async` y atributos `async/defer` gestionados por el `AssetManager` para cumplir con los estándares de Core Web Vitals 2024.
