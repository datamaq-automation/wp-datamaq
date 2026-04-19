# Microauditor??a: Home ??? Header Dimensions

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-header-dimensions |
| Archivo | docs/microauditorias/home-header-dimensions.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Global |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Header |
| Diferencia puntual | Desajuste en la altura del header y tama??o del icono del logo |
| Orden de trabajo | 3 |
| Commit de cierre | e2db4a6 |

## 2. Objetivo del microcambio

Ajustar las dimensiones verticales del header y el tama??o del icono del logo para que coincidan exactamente con la referencia Vue (64px de altura total y 40px para el icono). Esto asegurar?? la proporci??n correcta y la consistencia visual en todas las vistas.

## 3. Alcance

- Incluye:
  - Modificaci??n de `header.php` para actualizar la altura del `<header>` y del `.header-spacer` de 60px a 64px.
  - Actualizaci??n de los estilos CSS de `.c-logo-icon` para pasar de 28px/32px a **40px** (desktop y mobile).
  - Ajuste del `font-size` del car??cter `>_` dentro del icono para mantener la proporci??n.
- No incluye:
  - Cambio de colores o tipograf??as del texto del logo.
  - Ajuste de paddings laterales del contenedor.
- Riesgo principal:
  - Desplazamiento inesperado de elementos de la Home por el cambio de altura del spacer (m??nimo, solo 4px).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Altura Header | 64px (`h-16`) | 60px (inline style) | F12 / Computed styles | Alta |
| Tama??o Icono Logo | 40px x 40px | 28px (desktop) / 32px (mobile) | F12 / Inspect | Alta |
| Altura Spacer | 64px | 60px | Inspecci??n de c??digo | Alta |

## 5. Hallazgo confirmado

El header actual de WordPress es un 6% m??s bajo que el de Vue, y el icono del logo es significativamente m??s peque??o, lo que afecta la presencia de la marca y el "aire" visual de la cabecera.

## 6. Hip??tesis revisadas

1. Cambiar `height: 60px` por `height: 64px` en `header.php` resolver?? la altura global.
2. Actualizar las variables de la clase `.c-logo-icon` unificar?? el tama??o en 40px para todas las vistas, coincidiendo con la fuente de verdad.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Actualizar estilos inline y clases en `header.php`. | Consistencia inmediata en toda la web. | Desajuste menor de 4px en secciones ancladas. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Estilo / PHP | `header.php` | Cambio de altura de 60px a 64px. | Sincronizaci??n de ritmo vertical. |
| Estilo / PHP | `header.php` | Reducci??n de blur de 20px a 12px. | Ajuste a token de dise??o Vue. |
| CSS local | `header.php` | Unificaci??n de icono a 40px x 40px. | Presencia de marca id??ntica a Vue. |
| Markup | `header.php` | Ajuste de `header-spacer` a 64px. | Evitar saltos de contenido. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Altura Header | 64px (verificado por centrado). | Id??ntico. | OK |
| Tama??o Icono | 40px x 40px (verificado por DOM). | Id??ntico. | OK |
| Blur intensity | 12px perceptible. | Id??ntico. | OK |
| Mobile parity | Icono de 40px en men?? offcanvas. | Id??ntico. | OK |
| Regresi??n visible | Sin regresiones detectadas. | N/A | OK |


## 10. Evidencia t??cnica utilizada

### Snippet 1
**Objetivo:** Obtener dimensiones exactas en Vue
**Entorno:** Vue Reference
**Elemento o zona inspeccionada:** Header & Logo Icon

```js
const header = document.querySelector('header');
console.log(header.offsetHeight); // 64

const icon = document.querySelector('.c-logo-icon'); // o equivalente en Vue
console.log(icon.offsetWidth, icon.offsetHeight); // 40, 40
```

## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna en dimensiones b??sicas.
* ## Siguiente microauditor??a sugerida: `home-logo-parity.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `header.php` |
| Mensaje de commit | style(header): adjust height, logo size and blur to match Vue reference |
| Hash de commit | e2db4a6 |

## 13. Resumen ejecutivo

Se ha ajustado la altura del header a 64px y el tama??o del icono del logo a 40px, logrando una paridad dimensional perfecta con la versi??n Vue. Se corrigi?? el spacer para evitar saltos de contenido y se ajust?? el desenfoque del fondo a 12px. La microauditor??a se considera cerrada con ??xito.


