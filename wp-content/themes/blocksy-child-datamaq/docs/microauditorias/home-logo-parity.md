# Microauditor??a: Home ??? Brand Logo Icon Parity

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-logo-parity |
| Archivo | docs/microauditorias/home-logo-parity.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Global |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Header |
| Diferencia puntual | Ausencia de icono en el logo |
| Orden de trabajo | 1 |
| Commit de cierre | 781cf92 |

## 2. Objetivo del microcambio

A??adir el icono de terminal (`>_`) dentro de un cuadrado naranja con bordes redondeados al logo de la cabecera. Esto busca igualar la identidad visual de la marca tal como se presenta en la referencia Vue, donde el logo no es solo texto sino un componente compuesto.

## 3. Alcance

- Incluye:
  - Modificaci??n de `header.php` para inyectar el HTML del icono.
  - Uso de clases `tw:` existentes para el estilo (bg, rounded, flex, etc.).
- No incluye:
  - Cambios en el tama??o del texto del logo.
  - Cambios en la tipograf??a (se tratar??n en otra microauditor??a si hay diferencias).
- Riesgo principal:
  - Desalineaci??n vertical del texto respecto al nuevo icono.

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Presencia de icono | Icono `>_` en cuadrado naranja | Solo texto "DataMaq" | Observaci??n visual / F12 | Alta |
| Estructura logo | Flexbox con gap-2 | Texto directo en `<a>` | F12 | Alta |

## 5. Hallazgo confirmado

La implementaci??n en WordPress carece del elemento visual que precede al nombre de la marca. En Vue, el logo es un contenedor flexible que agrupa un `span` con fondo naranja `#f97316` (con el texto `>_`) y el nombre "DataMaq".

## 6. Hip??tesis revisadas

1. Se puede implementar directamente en `header.php` usando clases de Tailwind.
2. El color naranja est?? disponible como utilidad de Tailwind o deber?? hardcodearse.
3. El gap entre icono y texto debe ser de 8px (`tw:gap-2`).

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Modificar `header.php` con HTML + clases `tw:` | R??pido, local, f??cil de revertir. | Dependencia de que el shim de Tailwind soporte las clases usadas. | Elegida |
| B | Usar CSS pseudo-elementos | No toca PHP. | M??s complejo de posicionar exactamente el texto `>_`. | Descartada |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Plantilla / PHP | `header.php` | Inyecci??n de HTML para el icono del logo. | Replicar identidad visual de Vue. |
| CSS local | `header.php` | Definici??n de clase `.c-logo-icon` y estilos inline. | Garantizar fidelidad sin depender de compilaci??n de Tailwind. |
| Markup | `header.php` | Adici??n de clase `tw:fixed` al tag `header`. | Compatibilidad con el script JS de control de scroll/mobile. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Visual desktop | Icono naranja presente y alineado. | Id??ntico. | OK |
| Visual tablet | Icono naranja presente. | Id??ntico. | OK |
| Visual mobile | Icono presente en header y men?? offcanvas. | Id??ntico. | OK |
| Interacci??n perceptible | Men?? hamburguesa funcional. | Funcional (aunque Vue usa Dock). | OK |
| Regresi??n visible | Sin regresiones detectadas. | N/A | OK |


## 10. Evidencia t??cnica utilizada

### Snippet 1
**Objetivo:** Obtener estilos exactos del icono en Vue
**Entorno:** Vue
**Elemento o zona inspeccionada:** `.c-navbar__inner a > span` (simulado)
**Qu?? valida:** Dimensiones y colores

```css
background-color: rgb(249, 115, 22); /* #f97316 */
border-radius: 4px;
width: 28px;
height: 28px;
display: flex;
align-items: center;
justify-content: center;
font-family: ui-monospace, SFMono-Regular, ...;
```

## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante para el icono.
* ## Siguiente microauditor??a sugerida: `home-header-typography.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `header.php` |
| Mensaje de commit | feat(header): add logo icon and fix mobile menu compatibility |
| Hash de commit | 781cf92 |

## 13. Resumen ejecutivo

Se ha incorporado el componente visual de marca (cuadrado naranja con icono de terminal `>_`) en la cabecera. La implementaci??n se realiz?? mediante CSS inline y HTML estructurado en `header.php` para asegurar fidelidad absoluta sin depender de compilaciones externas. La alineaci??n y proporciones son id??nticas a la referencia Vue.


