# Microauditor??a: Home ??? FAQ Parity

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-faq-parity |
| Archivo | docs/microauditorias/home-faq-parity.md |
| Estado | Cerrada |
| Prioridad | Media |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | FAQ |
| Diferencia puntual | Desajuste en el badge, cantidad de items y dinamismo de los datos |
| Orden de trabajo | 8 |
| Commit de cierre | 697c1f8 |

## 2. Objetivo del microcambio

Sincronizar la secci??n de FAQ para que sea 100% din??mica bas??ndose en `site-data.php`, asegurando que se muestren las 6 preguntas reglamentarias y que el estilo del badge coincida con la jerarqu??a establecida (AYUDA en may??sculas y naranja).

## 3. Alcance

- Incluye:
  - Modificaci??n de `template-parts/content-faq.php`.
  - Reemplazo de los items hardcoded por un bucle `foreach` sobre `$data['items']`.
  - Sincronizaci??n del badge (texto "Ayuda", uppercase, color `#ff6a00`).
  - Ajuste de la clase de secci??n a `c-home-faq`.
- No incluye:
  - Cambio en la l??gica del acorde??n (`details`/`summary`).
  - Redise??o de las sombras o glows.

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Texto Badge | "AYUDA" | "Dudas comunes" | Observaci??n visual | Alta |
| Cantidad de Items | 6 | 4 | Conteo visual | Alta |
| Dinamismo | Basado en data | Hardcoded en el template | Inspecci??n de c??digo | Alta |

## 5. Hallazgo confirmado

La secci??n FAQ en WordPress es est??tica y contiene menos informaci??n de la que ya est?? disponible en el repositorio de datos centralizado del tema. El badge no sigue la norma de dise??o aplicada en el resto del sitio.

## 6. Hip??tesis revisadas

1. Implementar un bucle PHP sobre el array centralizado permitir?? mantener la paridad autom??tica si el snapshot de datos cambia en el futuro.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Dinamizar la secci??n FAQ completamente. | Mantenibilidad y paridad garantizada. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Markup | `content-faq.php` | Implementaci??n de bucle `foreach` din??mico. | Paridad de datos y escalabilidad. |
| Estilos | `content-faq.php` | Ajuste de badge a "AYUDA" (uppercase, #ff6a00). | Cohesi??n est??tica. |
| Estilos | `content-faq.php` | Adici??n de clase `c-home-faq`. | Identificaci??n t??cnica BEM. |
| Contenido | `content-faq.php` | Correcci??n de t??tulos y sincronizaci??n de los 6 items. | Precisi??n informativa. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| T??tulo H2 | "Preguntas frecuentes" | Id??ntico. | OK |
| Cantidad de Items | 6 items detectados y operativos. | Id??ntico. | OK |
| Texto Badge | "AYUDA" (Uppercase, Orange). | Id??ntico. | OK |
| Apertura/Cierre | Funcionalidad nativa `details` mantenida. | Id??ntico. | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: `home-footer-parity.md` (Auditor??a de la secci??n de Footer).

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `template-parts/content-faq.php`, `inc/site-data.php` |
| Mensaje de commit | style(faq): synchronize content and styles with Vue reference |
| Hash de commit | 697c1f8 |

## 13. Resumen ejecutivo

Se ha dinamizado la secci??n de preguntas frecuentes (FAQ), extrayendo los 6 ??tems del snapshot de Vue. Se actualizaron los badges a may??sculas con el color institucional `#ff6a00` y se implement?? la arquitectura BEM (`c-home-faq`), asegurando que la secci??n de ayuda sea totalmente coherente con la de la referencia local.
