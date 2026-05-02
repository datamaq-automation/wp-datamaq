# 🛠️ SRS: Sistema de Costos Datamaq

**Versión:** 1.1.0
**Objetivo:** Automatizar la presupuestación de servicios de ingeniería basados en geolocalización y tarifas técnicas.

## Requerimientos Funcionales
1. **RF1: Cálculo de Viáticos**: El sistema debe calcular la distancia entre la sede de Datamaq y el cliente usando Google Maps API.
2. **RF2: Precio Dinámico**: WooCommerce debe actualizar el precio del producto 251 basándose en `Tarifa_Base + (Distancia * Precio_KM)`.
3. **RF3: Modo Lectura Seguro**: El panel de administración debe estar bloqueado por defecto para evitar cambios accidentales en las tarifas.

## Reglas de Negocio
- Los precios calculados son bonificables en la contratación final de automatizaciones.
- No se permite el acceso al carrito sin haber proporcionado una dirección válida.
- El botón de WhatsApp actúa como cierre de venta post-calificación técnica.
