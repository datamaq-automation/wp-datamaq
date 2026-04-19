# Microauditor??a: Home ??? Process Parity

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-process-parity |
| Archivo | docs/microauditorias/home-process-parity.md |
| Estado | Cerrada |
| Prioridad | Media |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Proceso |
| Diferencia puntual | Datos faltantes en el repositorio central y desajuste est??tico |
| Orden de trabajo | 10 |
| Commit de cierre | a6f9bb0 |

## 2. Objetivo del microcambio

Sincronizar la secci??n "C??mo trabajamos" (Proceso) para que utilice los datos din??micos del repositorio centralizado y adopte la est??tica de la arquitectura BEM, incluyendo el trayecto de pasos y los estilos de badge unificados.

## 3. Alcance

- Incluye:
  - Modificaci??n de `inc/site-data.php` para incluir el bloque `process`.
  - Modificaci??n de `template-parts/content-proceso.php`.
  - Adici??n del branding (eyebrow "C??MO TRABAJAMOS").
  - Sincronizaci??n de los 4 pasos del proceso.
- No incluye:
  - Cambio en la disposici??n de cuadr??cula (ya es correcta 1x4).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Datos Centralizados | Presentes | Ausentes (Error de variable indefinida potencial) | Revisi??n de c??digo | Alta |
| Eyebrow Section | Presente | Ausente | Observaci??n visual | Alta |
| Estilo T??tulos | Black / Tracking-tighter | Normal | Observaci??n visual | Alta |

## 5. Hallazgo confirmado

La secci??n de proceso en WordPress intenta consumir datos de un repositorio centralizado que a??n no los contiene, lo que rompe el dinamismo. Adem??s, carece del elemento badge/eyebrow que identifica el inicio de cada secci??n en la nueva arquitectura t??cnica.

## 6. Hip??tesis revisadas

1. Completar el repositorio `site-data.php` con los 4 pasos definidos en Vue restablecer?? la funcionalidad completa de la secci??n.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Completar datos y ajustar estilos en `content-proceso.php`. | Paridad t??cnica y visual 100%. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Datos | `site-data.php` | Inclusi??n del objeto `process` con 4 pasos. | Centralizaci??n y sincronizaci??n de contenidos. |
| Markup | `content-proceso.php` | Adici??n de badge "C??MO TRABAJAMOS" y clase `c-home-process`. | Paridad t??cnica BEM. |
| Estilos | `content-proceso.php` | Uso de pesos `black` y `tracking-tighter` en t??tulos. | Fidelidad est??tica. |
| Datos | `content-proceso.php` | Dinamizaci??n total del bucle de pasos. | Mantenibilidad. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| T??tulo H2 | "Flujo de implementaci??n t??cnica" | Id??ntico. | OK |
| Cantidad de Pasos | 4 pasos correlativos (01-04). | Id??ntico. | OK |
| Texto Badge | "C??MO TRABAJAMOS" (Uppercase, Orange). | Id??ntico. | OK |
| Estilo N??meros | Grandes, sutiles (opacity 0.04). | Id??ntico. | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: `home-contact-parity.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `template-parts/content-proceso.php`, `inc/site-data.php` |
| Mensaje de commit | style(process): synchronize content and styles with Vue reference |
| Hash de commit | a6f9bb0 |

## 13. Resumen ejecutivo

Se ha implementado el flujo de trabajo de 4 pasos ("C??MO TRABAJAMOS") en WordPress, utilizando los datos din??micos de la referencia Vue. La secci??n incluye el estilo visual de n??meros de fondo sutiles y el badge institucional sincronizado en color y tipograf??a. Se han integrado las clases BEM (`c-home-process`), logrando paridad t??cnica completa.


