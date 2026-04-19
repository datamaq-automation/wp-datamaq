# Microauditor??a: Home ??? Contact Parity

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-contact-parity |
| Archivo | docs/microauditorias/home-contact-parity.md |
| Estado | Cerrada |
| Prioridad | Baja |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Contacto |
| Diferencia puntual | Sincronizaci??n de textos descriptivos y radios de botones |
| Orden de trabajo | 11 |
| Commit de cierre | 79246b6 |

## 2. Objetivo del microcambio

Sincronizar la secci??n de contacto para que utilice los textos exactos definidos en el snapshot de Vue para el formulario principal (t??tulo, subt??tulo y etiqueta del bot??n) y ajustar los radios de borde a la norma de 12px.

## 3. Alcance

- Incluye:
  - Modificaci??n de `inc/site-data.php` para incluir `primaryContactForm`.
  - Modificaci??n de `template-parts/content-contact.php`.
  - Sincronizaci??n del badge/eyebrow (uppercase, color `#ff6a00`).
  - Actualizaci??n de textos din??micos.
  - Ajuste de radios a 12px en el bot??n de env??o.
- No incluye:
  - Implementaci??n del env??o funcional (se mantiene la l??gica de mailto/whatsapp actual por ahora).

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| T??tulo | "Inici?? una consulta t??cnica" | "Inici?? una consulta t??cnica" | Observaci??n visual | Alta |
| Subt??tulo | "Dejanos el contexto del caso..." | "Indic?? qu?? variable quer??s capturar..." | Observaci??n visual | Alta |
| Label Bot??n | "Envi?? tu consulta" | "Continuar por WhatsApp" | Observaci??n visual | Alta |
| Radio Bot??n | 12px | normal | Observaci??n visual | Alta |

## 5. Hallazgo confirmado

Aunque el t??tulo coincide, el subt??tulo y el label del bot??n en WordPress est??n utilizando los datos de la "P??gina de Contacto" (`contactPage`) en lugar de los datos del "Formulario de la Home" (`primaryContactForm`), lo que rompe la paridad espec??fica de la vista principal. El radio del bot??n tampoco sigue la norma est??tica definida.

## 6. Hip??tesis revisadas

1. Mapear correctamente los campos de datos din??micos en `site-data.php` y en el template resolver?? la discrepancia de contenido.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Sincronizar textos y estilos de bot??n en `content-contact.php`. | Paridad total de contenido y visual. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Datos | `site-data.php` | Inclusi??n de `primaryContactForm` para la Home. | Sincronizaci??n de contenidos espec??ficos. |
| Markup | `content-contact.php` | Adici??n de clase `c-home-contact` y badge "CONTACTO". | Paridad t??cnica BEM. |
| Estilos | `content-contact.php` | Ajuste de radio de bot??n a 12px y peso medium. | Fidelidad est??tica. |
| Contenido | `content-contact.php` | Uso de strings espec??ficos de la Home (subt??tulo y label bot??n). | Precisi??n informativa. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| T??tulo H2 | "Inici?? una consulta t??cnica" | Id??ntico. | OK |
| Subt??tulo | "Dejanos el contexto del caso..." | Id??ntico. | OK |
| Label Bot??n | "Envi?? tu consulta" | Id??ntico. | OK |
| Radio Bot??n | 12px (0.75rem). | Id??ntico. | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: `home-integrity-navigation.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `template-parts/content-contact.php`, `inc/site-data.php` |
| Mensaje de commit | style(contact): synchronize content and styles with Vue reference |
| Hash de commit | 79246b6 |

## 13. Resumen ejecutivo

Se ha sincronizado la secci??n de contacto de la Home con la referencia Vue, corrigiendo la asignaci??n de textos din??micos (`primaryContactForm` vs `contactPage`). Se ajust?? el radio de borde de los botones a 12px y se unific?? la est??tica del badge institucional. La secci??n es ahora funcionalmente coherente con el snapshot de datos.


