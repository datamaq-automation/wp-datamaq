# Microauditor??a: Home ??? Footer Parity

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-footer-parity |
| Archivo | docs/microauditorias/home-footer-parity.md |
| Estado | Cerrada |
| Prioridad | Baja |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Footer |
| Diferencia puntual | Desajuste en el layout, textos legales y etiquetas del dock m??vil |
| Orden de trabajo | 9 |
| Commit de cierre | d021868 |

## 2. Objetivo del microcambio

Sincronizar el footer y el dock de navegaci??n m??vil para lograr paridad estructural y de contenido con la referencia Vue. Esto incluye la adici??n del texto legal din??mico y la actualizaci??n de las etiquetas de navegaci??n r??pida.

## 3. Alcance

- Incluye:
  - Modificaci??n de `footer.php`.
  - Implementaci??n de la estructura `c-home-footer__shell` (Brand, Legal, WhatsApp).
  - Sincronizaci??n de los labels del dock (Inicio, Soluci??n, Perfil, Contacto).
  - Uso de datos din??micos de `site-data.php` para el texto legal y nota al pie.
- No incluye:
  - Cambios en el `wp_footer()` o scripts de terceros.
  - Modificaci??n del FAB de WhatsApp (ya es funcional).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Layout Footer | Shell flexible (1 fila) | 2 filas (Stack) | Observaci??n visual | Alta |
| Texto Legal | Presente | Ausente | Observaci??n visual | Alta |
| Labels Dock | Inicio, Soluci??n, Perfil, Contacto | INICIO, SOLUCI??N, FAQ, CONTACTO | Observaci??n visual | Alta |
| Label WhatsApp | "Escribime" | Icono solo | Observaci??n visual | Alta |

## 5. Hallazgo confirmado

El footer actual de WordPress es una versi??n simplificada que no incluye la informaci??n legal requerida ni sigue la estructura de dise??o unificada. El dock m??vil utiliza etiquetas en may??sculas y omite el enlace al perfil t??cnico, que es una pieza clave de la navegaci??n en la versi??n Vue.

## 6. Hip??tesis revisadas

1. Reestructurar el footer para usar un contenedor de tipo "shell" permitir?? albergar los tres bloques de informaci??n (Marca, Legal, Acci??n) en una sola l??nea en escritorio, mejorando la sofisticaci??n visual.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Sincronizar footer y dock con `site-data.php`. | Paridad total y datos centralizados. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Layout | `footer.php` | Reestructuraci??n a `c-home-footer__shell` (flex-row). | Paridad t??cnica y est??tica "premium". |
| Contenido | `footer.php` | Inclusi??n de nota legal din??mica y footer note. | Cumplimiento informativo. |
| Navegaci??n | `footer.php` | Actualizaci??n de etiquetas del dock m??vil (Perfil a??adido). | Consistencia en UX m??vil. |
| Estilos | `footer.php` | Clase `c-home-footer` a??adida. | Identificaci??n t??cnica BEM. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Label WhatsApp | "Escribime" presente en el footer. | Id??ntico. | OK |
| Texto Legal | Visible y alineado en el centro. | Id??ntico. | OK |
| Dock Labels | Inicio, Soluci??n, Perfil, Contacto. | Id??ntico. | OK |
| Responsive | Layout shell se apila verticalmente en m??vil. | Id??ntico. | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: `home-process-parity.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `footer.php`, `inc/site-data.php` |
| Mensaje de commit | style(footer): synchronize shell layout and dock labels with Vue reference |
| Hash de commit | d021868 |

## 13. Resumen ejecutivo

Se ha redise??ado el pie de p??gina (Footer) eliminando la estructura de columnas de Blocksy a favor de una "footer shell" de una sola fila alineada con Vue. Se ha sincronizado el dock m??vil con los labels capturados en el snapshot y se ha automatizado la gesti??n de textos legales con strings din??micos. La paridad global de la base de la p??gina es ahora total.
