# Microauditor??a: Home ??? Integrity & Navigation

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-integrity-navigation |
| Archivo | docs/microauditorias/home-integrity-navigation.md |
| Estado | Cerrada |
| Prioridad | Media |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Home |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Header / Global |
| Diferencia puntual | Enlaces de navegaci??n rotos o inconsistentes |
| Orden de trabajo | 12 |
| Commit de cierre | 35af1e4 |

## 2. Objetivo del microcambio

Asegurar la integridad funcional de la navegaci??n en la Home page, eliminando enlaces a secciones inexistentes y sincronizando los anclajes con la estructura real de componentes implementada.

## 3. Alcance

- Incluye:
  - Modificaci??n de `header.php` (Desktop y Mobile).
  - Eliminaci??n de los enlaces "#tarifas" y "#cobertura".
  - Adici??n del enlace "#perfil".
  - Verificaci??n de los IDs de anclaje en todos los `template-parts`.
- No incluye:
  - Creaci??n de nuevas secciones de contenido.

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Links Navegaci??n | Soluci??n, Proceso, Perfil, FAQ | Soluci??n, Proceso, Alcance, Cobertura, FAQ | Inspecci??n de c??digo | Alta |
| IDs Secciones | `#servicios`, `#proceso`, `#perfil`, `#faq` | `#servicios`, `#proceso`, `#perfil` (Ok), `#faq` | Inspecci??n de c??digo | Alta |

## 5. Hallazgo confirmado

La barra de navegaci??n de WordPress contiene enlaces ("Alcance", "Cobertura") que no tienen una secci??n correspondiente en el DOM, lo que genera una experiencia de usuario fallida. El enlace clave al "Perfil" est?? ausente en la botonera principal, a pesar de que la secci??n existe y es funcional.

## 6. Hip??tesis revisadas

1. Sincronizar el men?? del `header.php` con el snapshot de Vue restaurar?? la coherencia 1:1 en la navegaci??n del sitio.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Actualizar men?? en `header.php` y validar anclajes. | Navegaci??n profesional y funcional. | Ninguno. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Navegaci??n | `header.php` | Actualizaci??n de items en men?? Desktop y Mobile. | Eliminaci??n de links rotos y paridad con Vue. |
| Navegaci??n | `header.php` | Reemplazo de Alcance/Cobertura por Perfil. | Sincronizaci??n funcional. |
| Integridad | Global | Verificaci??n de IDs de anclaje en todos los templates. | Evitar navegaci??n fallida. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Link #perfil | Funcional y desplaza a la secci??n. | Id??ntico. | OK |
| Links eliminados | Alcance y Cobertura removidos con ??xito. | Id??ntico. | OK |
| Mobile Menu | Sincronizado y funcional. | Id??ntico. | OK |


## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante.
* ## Siguiente microauditor??a sugerida: Final de la Fase de Documentaci??n y Paridad (Home).

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `header.php` |
| Mensaje de commit | style(nav): synchronize navigation links with Vue reference |
| Hash de commit | 35af1e4 |

## 13. Resumen ejecutivo

Se ha restaurado la integridad de la navegaci??n en la Home Page, eliminando enlaces a secciones inexistentes ("Alcance", "Cobertura") y a??adiendo el enlace funcional a "#perfil". Se valid?? que todos los anclajes dirijan a sus respectivos componentes BEM, sincronizando la experiencia de usuario con la arquitectura de la referencia Vue.

