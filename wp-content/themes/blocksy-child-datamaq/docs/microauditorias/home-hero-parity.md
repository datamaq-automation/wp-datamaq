# Microauditor??a: Home ??? Hero Content & Styles

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-hero-content-styles |
| Archivo | docs/microauditorias/home-hero-content-styles.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Hero |
| Diferencia puntual | Desajuste en el badge (caso y color), ausencia de imagen e IDs de secci??n |
| Orden de trabajo | 5 |
| Commit de cierre | 69b23ea |

## 2. Objetivo del microcambio

Sincronizar el contenido y los estilos b??sicos de la secci??n Hero en la Home. Esto incluye corregir el Badge (ponerlo en may??sculas y color primario), asegurar que la imagen del Hero se cargue correctamente desde `site-data.php` y a??adir las clases identificadoras de BEM (`c-home-hero`) para consistencia con la documentaci??n de auditor??a.

## 3. Alcance

- Incluye:
  - Modificaci??n de `inc/site-data.php` para a??adir la URL de la imagen del hero.
  - Modificaci??n de `template-parts/content-hero.php` para a??adir la clase `c-home-hero` a la secci??n.
  - Ajuste del estilo del badge (`.c-home-hero__eyebrow`) para usar `text-transform: uppercase` y el color `#ff6a00`.
- No incluye:
  - Redise??o completo del layout (grid, glows).
  - Implementaci??n de la caja de informaci??n "Estado: Online" (ya existe una b??sica, se ajustar?? si es necesario).
- Riesgo principal:
  - Errores de PHP si la clave `image` no se gestiona correctamente en el array `$data`.

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Texto Badge | MAY??SCULAS | Min??sculas / Capitalizado | Observaci??n visual | Alta |
| Color Badge | `#ff6a00` | Blanco o gris suave | Inspecci??n CSS | Media |
| Imagen Hero | `/media/hero-energy.svg` | No se visualiza (clave faltante) | Inspecci??n DOM / Network | Alta |
| Clase Seccional | `.c-home-hero` | No existe en el DOM | Inspecci??n DOM | Alta |

## 5. Hallazgo confirmado

La secci??n Hero en WordPress est?? incompleta a nivel de datos (falta la imagen en el modelo de datos `site-data.php`) y carece de las convenciones de nombrado BEM que se esperan para la paridad t??cnica. El badge no transmite la fuerza visual del original por falta de transformaci??n de texto y color de marca.

## 6. Hip??tesis revisadas

1. A??adir `'image' => $theme_url . '/assets/media/hero-energy.svg'` a `inc/site-data.php` resolver?? la carga de la imagen.
2. A??adir la clase `c-home-hero` a la `<section>` permitir?? que las herramientas de auditor??a identifiquen la secci??n correctamente.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Actualizar `site-data.php` y `content-hero.php`. | Soluci??n limpia y centrada en los datos. | Ninguno significativo. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Datos | `site-data.php` | Adici??n de la clave `'image'` al array hero. | Permitir la carga de la imagen principal. |
| Markup | `content-hero.php` | Adici??n de clase `c-home-hero` e ID `hero`. | Paridad t??cnica y BEM. |
| Estilos | `content-hero.php` | Estilos inline para el badge (uppercase, color #ff6a00). | Fidelidad visual a la referencia Vue. |
| Estilos | `content-hero.php` | Ajuste de bordes y radios en los botones de CTA. | Consistencia premium (12px radius). |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Visibilidad Imagen | Imagen `hero-energy.svg` visible y cargada. | Id??ntico. | OK |
| Texto Badge | En MAY??SCULAS y color naranja #ff6a00. | Id??ntico. | OK |
| Identificadores | `id="hero"` y `.c-home-hero` presentes. | Id??ntico. | OK |
| Funcionalidad | Botones clicables y anclajes correctos. | Id??ntico. | OK |
| Regresi??n visible | Sin regresiones detectadas en el Hero. | N/A | OK |


## 10. Evidencia t??cnica utilizada

### Snippet 1
**Objetivo:** Verificar estructura de datos en WP
**Entorno:** WordPress Child Theme
**Archivo:** `inc/site-data.php`

```php
// Faltaba la clave image en el array hero
'hero' => [
    'badge' => '...',
    'image' => $theme_url . '/assets/media/hero-energy.svg' // Acci??n necesaria
]
```

## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante en el Hero.
* ## Siguiente microauditor??a sugerida: `home-profile-styles.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `inc/site-data.php`, `template-parts/content-hero.php` |
| Mensaje de commit | feat(hero): fix missing image and sync badge styles with Vue reference |
| Hash de commit | 69b23ea |

## 13. Resumen ejecutivo

Se ha completado la sincronizaci??n del contenido y la est??tica del Hero. Se integr?? la imagen principal (`hero-energy.svg`) mediante el repositorio central de datos y se ajustaron los estilos del badge (may??sculas y color naranja) y los radios de borde de los botones (12px), logrando una paridad visual premium id??ntica a Vue.


