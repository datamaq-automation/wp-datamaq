# 🔍 DISCOVERY: Dudas y Definiciones Pendientes

## Producto 252: Automatización a Medida
- **Duda**: ¿Cómo se calculará el precio de este servicio? ¿Será mediante un configurador de horas (Ingeniería + Montaje) o un formulario de solicitud de presupuesto avanzado?
- **Estado**: Pendiente de definición de reglas de negocio.

## Hallazgos Técnicos Recientes (02-Mayo-2026)

### 1. Incompatibilidad de Conditional Tags en Entorno Vue.js
- **Problema**: Las funciones nativas de WordPress/WooCommerce como `is_product()` y `get_the_ID()` devuelven resultados inconsistentes o `false` en el entorno web del tema.
- **Impacto**: La lógica de encolado de scripts (`wp_enqueue_scripts`) falla, impidiendo que el motor JS de la calculadora se cargue en el cliente.
- **Solución Propuesta**: Implementar un `ContextService` que detecte el contexto mediante el objeto global `$post` o la URL.

### 2. Advertencias de Performance en Google Maps API
- **Problema**: La API se carga de forma síncrona, bloqueando el renderizado.
- **Mejora**: Migrar a carga asíncrona mediante filtros de script en WordPress.

### 3. Ruido de Conexión en Terceros
- **Observación**: Fallos de conexión en Chatwoot (`ERR_CONNECTION_REFUSED`) generan ruido en la consola de debug, dificultando la observabilidad de los logs del plugin.

## Integración de Google Places
- **Duda**: ¿La API Key actual tiene permisos para "Places API"?
- **Acción**: Validar en el próximo test de conectividad desde el frontend.

## Flujo de WhatsApp
- **Duda**: ¿Deseas que el mensaje de WhatsApp incluya automáticamente los datos calculados (ej: "Hola, acabo de calcular un relevamiento de 45km...")?
- **Impacto**: Requiere pasar parámetros JS al enlace de WhatsApp.

## Navegación (Navbar)
- **Duda**: ¿Deseas que los botones del Navbar ("Relevamiento" y "Automatización") tengan colores de acento específicos para diferenciarse del resto del menú?
