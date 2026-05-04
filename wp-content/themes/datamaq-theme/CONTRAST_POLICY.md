# Política de Contraste y Accesibilidad Visual - DataMaq

Esta normativa define los estándares técnicos para garantizar la legibilidad en toda la plataforma DataMaq, cumpliendo con los objetivos de la Fase 3 del Plan de Mejora.

## 1. Estándar de Contraste (WCAG 2.1 AA)
Todo texto en la plataforma debe cumplir con un ratio de contraste mínimo respecto a su fondo:
- **Texto Normal:** 4.5:1
- **Texto Grande (18pt+ o 14pt bold+):** 3.0:1

## 2. Uso Obligatorio de Design Tokens
Queda estrictamente prohibido el uso de colores en formato Hexadecimal, RGB o HSL directamente en los archivos CSS de componentes o plugins. Se deben utilizar los tokens definidos en `tokens.css`.

### Correcto:
```css
.my-component {
    color: var(--dm-surface-text);
    background-color: var(--dm-surface-bg);
}
```

### Incorrecto:
```css
.my-component {
    color: #ffffff !important;
    background-color: #0c092f;
}
```

## 3. Gestión de Contextos (Surfacing)
La plataforma utiliza un sistema de contextos dinámicos. Antes de aplicar estilos, se debe identificar en qué superficie se encuentra el elemento:

- **is-dark-context (Default):** Fondos oscuros (`#0c092f`). Texto blanco.
- **is-light-context:** Fondos claros (`#ffffff`). Texto oscuro (`#050314`).

Si un nuevo componente (ej. un modal de terceros) introduce un fondo claro, se debe envolver en la clase `.is-light-context` para que los tokens hijos se recalculen automáticamente.

## 4. Observabilidad en Tiempo de Ejecución
La plataforma incluye un monitor de salud (`ui-health-monitor.js`) que reporta fallos de contraste críticos a la consola y al objeto global `window.dm_ui_health`. 

**Regla de Oro:** Si el monitor detecta un fallo, el cambio de CSS debe ser revertido y refactorizado usando tokens semánticos.

---
*Última actualización: Mayo 2026*
