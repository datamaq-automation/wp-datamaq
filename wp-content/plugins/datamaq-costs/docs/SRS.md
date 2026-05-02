# Especificación de Requisitos de Software (SRS) - Datamaq Costs

## 1. Introducción
Este plugin está diseñado para automatizar y estandarizar el proceso de presupuestación de los dos productos principales de Datamaq: Relevamiento Técnico y Soluciones de Automatización a Medida.

## 2. Producto 1: Relevamiento Técnico y Visita a Planta
### 2.1 Cálculo de Costos
- **Fórmula:** `Costo Total = Tarifa Base + (KM Totales * Valor por KM)`
- **Cálculo de Distancia:** 
    - Obtención automatizada mediante la **API de Google Distance Matrix**.
    - Calcula la distancia desde la **Dirección de Origen de Datamaq** hasta la **Dirección de Destino del Cliente**.
- **Respaldo Manual (Fallback):** Si la API falla o no se encuentra la dirección, el administrador debe poder ingresar los KM manualmente.
- **Disparador:** Se inicia a través de un formulario de "Solicitud de Presupuesto" previo al proceso de checkout.

## 3. Producto 2: Solución de Automatización a Medida
### 3.1 Cálculo de Costos
- **Fórmula:** `Costo Total = (Horas de Ingeniería * Valor Hora Ingeniería) + (Horas de Montaje * Valor Hora Montaje)`
- **Estado:** Los valores de las tarifas (Ingeniería/Montaje) están actualmente pendientes de definición.

## 4. Configuración y Ajustes
### 4.1 Panel de Administración
El plugin debe proporcionar una página de ajustes en WordPress para gestionar:
- **Google Maps API Key:** Para los cálculos de distancia.
- **Dirección de Origen:** Ubicación física de Datamaq.
- **Tarifas Unitarias:**
    - Valor por KM (Viáticos).
    - Valor Hora Ingeniería.
    - Valor Hora Montaje.
- **Tarifa Base:** Para el Relevamiento Técnico.

## 5. Interfaz de Usuario
- **Frontend:** Un formulario específico de "Solicitud de Presupuesto" que capture la dirección del cliente y los detalles del proyecto.
- **Admin:** Integración con el panel de WooCommerce/WordPress para revisar y aprobar los presupuestos calculados.
