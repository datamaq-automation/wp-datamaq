# Microauditor??a: Home ??? Header Typography

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-header-typography |
| Archivo | docs/microauditorias/home-header-typography.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Global |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Header |
| Diferencia puntual | Desajuste en tipograf??a, pesos y radios de los elementos del men?? |
| Orden de trabajo | 4 |
| Commit de cierre | eb07534 |

## 2. Objetivo del microcambio

Sincronizar la tipograf??a y los estilos de interacci??n del header con la referencia Vue. Esto incluye ajustar el tama??o de fuente, peso, color base y color de hover de los enlaces, as?? como el peso y radio de borde del bot??n CTA.

## 3. Alcance

- Incluye:
  - Modificaci??n de los estilos de los enlaces (`<a>`) en `header.php` (Desktop).
  - Ajuste del bot??n CTA (`tw:btn-primary` o equivalente inyectado).
  - Unificaci??n de colores de marca (usar `#ff6a00` para hover/primario).
  - Ajuste de radios de borde (12px para botones).
- No incluye:
  - Cambio en el contenido de los men??s (ya realizado).
  - Cambio de la fuente global del sitio (se asume Inter desde el tema base).
- Riesgo principal:
  - Legibilidad si el color `#e2e9f3` con 88% de opacidad no tiene suficiente contraste contra el fondo (en Vue est?? validado).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Fuente Enlaces | 15.68px / Peso 400 | ~16px / Peso bold (actual tipado) | F12 / Inspect | Alta |
| Color Enlaces | `rgba(226, 233, 243, 0.88)` | `tw:text-white/90` | Inspecci??n CSS | Alta |
| Color Hover | `#ff6a00` | `#ff9a4d` | Inspecci??n de c??digo | Alta |
| Peso CTA | 500 (font-medium) | 700 (font-bold) | Inspecci??n visual | Alta |
| Radio CTA | 12px (rounded-xl) | Blocksy default (prob 4-6px) | Inspecci??n visual | Alta |

## 5. Hallazgo confirmado

La tipograf??a actual en WordPress es demasiado "pesada" (mucho bold) y el color naranja de hover no es el exacto. Adem??s, los botones no tienen el radio de borde premium (12px) de la referencia Vue.

## 6. Hip??tesis revisadas

1. Inyectar clases de Tailwind espec??ficas o estilos inline en `header.php` permitir?? alcanzar la fidelidad sin afectar el resto del sitio.
2. Usar `tw:font-medium` (500) en lugar de `tw:font-bold` para el CTA mejorar?? la est??tica premium.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Uso de clases arbitrarias de Tailwind y estilos CSS en `header.php`. | Control total sobre la zona auditada. | Duplicidad de estilos si no se gestionan bien. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Estilo / PHP | `header.php` | Inyecci??n de clases `.dm-nav-link` y `.dm-btn-cta`. | Control preciso de tipograf??a sin Tailwind full bundle. |
| Tipograf??a | `header.php` | Ajuste de font-size a 15.68px y peso 400. | Fidelidad al dise??o Inter en Vue. |
| Colores | `header.php` | Uso de `#e2e9f3/88` y `#ff6a00`. | Paridad crom??tica de marca. |
| Formas | `header.php` | Ajuste de border-radius a 12px en CTA. | Mejora de est??tica visual (premium). |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Color Enlaces | rgba(226, 233, 243, 0.88) | Id??ntico. | OK |
| Peso Enlaces | 400 (normal) | Id??ntico. | OK |
| Radio Bot??n | 12px | Id??ntico. | OK |
| Hover behavior | Color #ff6a00 con transici??n suave. | Id??ntico. | OK |
| Regresi??n visible | Sin regresiones detectadas. | N/A | OK |


## 10. Evidencia t??cnica utilizada

### Snippet 1
**Objetivo:** Obtener tokens exactos de tipograf??a
**Entorno:** Vue SCSS Tokens
**Archivo:** `_dm.tokens.scss` / `_navbar.scss`

```scss
$dm-text-0: #e2e9f3;
.nav-link {
  font-size: 0.98rem;
  color: rgba($dm-text-0, 0.88);
  transition: color 0.2s ease;
  &:hover { color: #ff6a00; }
}
```

## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante en el header.
* ## Siguiente microauditor??a sugerida: `home-hero-content-styles.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `header.php` |
| Mensaje de commit | style(header): synchronize navigation typography and button styles |
| Hash de commit | eb07534 |

## 13. Resumen ejecutivo

Se ha sincronizado la tipograf??a del men?? con los tokens exactos de Vue (Inter, 15.68px, peso 400). Asimismo, se ha unificado el color de hover a `#ff6a00` y se ha aplicado un border-radius de 12px al bot??n CTA para elevar la percepci??n premium del sitio. La microauditor??a se considera exitosa y cerrada.


