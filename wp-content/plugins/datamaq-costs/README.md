# 🏁 Datamaq Costs Plugin

Sistema avanzado de gestión de costos críticos y presupuestación automatizada para servicios de ingeniería.

## 🚀 Características Principales
- **Cálculo Dinámico de Viáticos**: Integración con Google Maps Distance Matrix para calcular costos basados en la distancia real.
- **Flujo de Compra Unificado**: Controla y habilita el botón nativo de WooCommerce solo cuando se completan los datos técnicos obligatorios.
- **Arquitectura Robusta**: Basado en Clean Architecture para una separación clara de responsabilidades.
- **Performance 2024**: Carga optimizada de APIs externas (Google Maps) con técnicas de async/loading.
- **Gestión de Servicios Externos**: Control centralizado de widgets (ej. Chatwoot) desde el panel de administración.
- **Modo Edición Seguro**: Panel de ajustes protegido para evitar cambios accidentales en producción.

## 🛠️ Stack Técnico
- **Backend**: PHP 8.1+ / WordPress Hooks / WooCommerce API.
- **Frontend**: Vanilla JS (jQuery compatible) / CSS3 (BEM Methodology).
- **APIs**: Google Maps (Distance Matrix, Places Autocomplete).
- **DOM Bridge**: MutationObserver para integración en temas basados en Vue.js.

## 📂 Documentación
- [Arquitectura Detallada](docs/ARQUITECTURA.md): Capas del sistema y mecanismos de integración.
- [Reglas de Negocio (SRS)](docs/SRS.md): Requerimientos funcionales y técnicos.
- [Guía de Google API](docs/GUIA_GOOGLE_API.md): Configuración de credenciales y cuotas.
- [Hoja de Ruta (TODO)](docs/TODO.md): Estado actual del desarrollo y tareas próximas.

## ⚙️ Configuración Rápida
1. **Activar**: Instalar y activar el plugin en WordPress.
2. **Ajustes**: Ir a `Ajustes > Datamaq Costs`.
3. **Modo Edición**: Activar el interruptor de seguridad para habilitar los campos.
4. **Google Cloud**: Ingresar la API Key (asegurarse de tener habilitadas *Distance Matrix* y *Places*).
5. **WooCommerce**: Configurar el producto ID 251 como "Vendido Individualmente".

---
*Desarrollado por Datamaq Engineering Automation.*
