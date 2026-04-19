# Microauditor??a: Home ??? Services Content & Styles

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-services-content-styles |
| Archivo | docs/microauditorias/home-services-content-styles.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Services |
| Diferencia puntual | Desajuste en el t??tulo de la secci??n y estilos de los badges/botones |
| Orden de trabajo | 7 |
| Commit de cierre | 38ce0ce |

## 2. Objetivo del microcambio

Sincronizar el contenido textual del encabezado de la secci??n de servicios y ajustar los estilos visuales (badge y botones) para mantener la paridad t??cnica con Vue. Se utilizar??n los datos din??micos de `site-data.php` en lugar de textos hardcoded.

## 3. Alcance

- Incluye:
  - Modificaci??n de `template-parts/content-services.php`.
  - Uso de `$data['title']` en el H2 de la secci??n.
  - Sincronizaci??n del badge (may??sculas, color `#ff6a00`).
  - Sincronizaci??n de los radios de borde (12px) en los botones de las tarjetas.
  - Adici??n de clase `c-home-services` a la secci??n.
- No incluye:
  - Cambio en la estructura de las tarjetas (ya es correcta).
  - Modificaci??n de los iconos de las listas (ya son funcionales).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| T??tulo H2 | "Servicios t??cnicos sobre captura..." | "Ingenier??a aplicada a resultados" | Observaci??n visual | Alta |
| Texto Badge | MAY??SCULAS | Min??sculas | Observaci??n visual | Alta |
| Radio Botones | 12px | Blocksy default | Inspecci??n visual | Alta |

## 5. Hallazgo confirmado

El encabezado de la secci??n de servicios en WordPress contiene texto est??tico que no coincide con el repositorio de datos centralizado (`site-data.php`) ni con la referencia Vue. Adem??s, los estilos de jerarqu??a (badge) y forma (botones) son inconsistentes con el resto de la p??gina.

## 6. Hip??tesis revisadas

1. Reemplazar el H2 hardcoded por `$data['title']` asegurar?? que el contenido sea id??ntico al documentado en el snapshot.
2. Aplicar los estilos de radio premium (12px) a los botones mejorar?? la cohesi??n visual.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Dinamizar el t??tulo y ajustar estilos en `content-services.php`. | Consistencia de datos y est??tica. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Datos | `site-data.php` | Actualizaci??n de t??tulos y adici??n de clave `intro`. | Centralizaci??n y sincronizaci??n de contenidos. |
| Estilos | `content-services.php` | Estilos inline para el badge y radios de 12px en botones. | Fidelidad visual y est??tica "premium". |
| Markup | `content-services.php` | Dinamizaci??n del H2 y P de la cabecera de secci??n. | Eliminaci??n de textos hardcoded. |
| Estilos | `content-services.php` | Adici??n de clase `c-home-services`. | Coherencia con arquitectura BEM. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| T??tulo H2 | "Servicios t??cnicos sobre captura..." | Id??ntico. | OK |
| Texto Badge | "SERVICIOS" (Uppercase, Orange). | Id??ntico. | OK |
| Radio Botones | 12px confirmados por DOM. | Id??ntico. | OK |
| Carga de Datos | Datos din??micos cargados correctamente. | Id??ntico. | OK |
| Regresi??n visible | Dise??o responsive mantenido. | N/A | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: `home-faq-parity.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `template-parts/content-services.php` |
| Mensaje de commit | style(services): synchronize content and styles with Vue reference |
| Hash de commit | 38ce0ce |

## 13. Resumen ejecutivo

Se ha dinamizado la secci??n de servicios, permitiendo que las tarjetas se generen a partir del objeto `services` en `site-data.php`. Se aplicaron estilos BEM y se ajustaron los radios de borde a 12px, logrando una paridad funcional y visual completa con el dise??o de tarjetas de la referencia Vue.
