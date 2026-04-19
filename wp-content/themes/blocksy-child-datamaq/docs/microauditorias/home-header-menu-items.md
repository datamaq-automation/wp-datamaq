# Microauditor??a: Home ??? Header Menu Items

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| ID | home-header-menu-items |
| Archivo | docs/microauditorias/home-header-menu-items.md |
| Estado | Cerrada |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Fecha de cierre | 2026-04-19 |
| Vista o p??gina afectada | Global |
| URL Vue | http://localhost:5173 |
| URL WordPress | https://datamaq.com.ar |
| Secci??n | Header |
| Diferencia puntual | Desajuste en los elementos y etiquetas del men?? de navegaci??n |
| Orden de trabajo | 2 |
| Commit de cierre | f117e70 |

## 2. Objetivo del microcambio

Sincronizar exactamente los ??tems del men?? de navegaci??n de WordPress con la referencia Vue. Esto incluye a??adir los enlaces faltantes (`Proceso`, `Alcance`, `Cobertura`) e igualar las etiquetas (cambiar "Contacto" por "Escribime" en el CTA). El objetivo es que la navegaci??n principal sea id??ntica en contenido y orden a la fuente de verdad.

## 3. Alcance

- Incluye:
  - Modificaci??n de `header.php` (Desktop y Mobile Offcanvas) para actualizar la lista de enlaces y etiquetas.
  - Sincronizaci??n de los hashes de destino (`#servicios`, `#proceso`, `#tarifas`, `#cobertura`, `#faq`, `#contacto`).
- No incluye:
  - Ajuste de estilos CSS de los enlaces (se tratar??n en otra microauditor??a si hay diferencias).
  - Creaci??n de las secciones de destino en el cuerpo de la Home (esto se asume que existe o se crear?? en fases posteriores; esta auditor??a solo cubre el Header).
- Riesgo principal:
  - Enlaces "rotos" (que no desplazan) si las secciones de destino a??n no tienen el ID correcto en WordPress.

## 4. Evidencia inicial

| Aspecto auditado | Referencia en Vue | Observaci??n en WordPress | M??todo de verificaci??n | Nivel de certeza |
|---|---|---|---|---|
| Lista de ??tems | Soluci??n, Proceso, Alcance, Cobertura, FAQ, Contacto | Soluci??n, FAQ, Contacto | Observaci??n visual / F12 | Alta |
| Etiqueta CTA | Escribime | Contacto / Escribime (m??vil) | Observaci??n visual | Alta |
| Orden | Ver lista arriba | Soluci??n, FAQ, Contacto | Observaci??n visual | Alta |

## 5. Hallazgo confirmado

El men?? actual de WordPress es una versi??n simplificada del que existe en Vue. Faltan tres puntos clave de navegaci??n (`Proceso`, `Alcance`, `Cobertura`) y la etiqueta del bot??n de contacto principal difiere ("Contacto" vs "Escribime").

## 6. Hip??tesis revisadas

1. La estructura de `header.php` permite a??adir los nuevos `<li>` directamente.
2. Debemos usar `home_url('#...')` para mantener la compatibilidad con navegaci??n desde otras p??ginas si fuera necesario, aunque Vue use hashes puros.
3. El men?? m??vil (offcanvas) debe actualizarse en paralelo para mantener la paridad.

## 7. Decisi??n de implementaci??n

| Opci??n | Descripci??n | Ventajas | Riesgos | Decisi??n |
|---|---|---|---|---|
| A | Modificar `header.php` inyectando los nuevos ??tems. | Paridad inmediata en el elemento global. | Enlaces no funcionales hasta que las secciones tengan sus IDs. | Elegida |

## 8. Cambios aplicados

| Tipo de cambio | Archivo(s) afectados | Descripci??n breve | Motivo |
|---|---|---|---|
| Plantilla / PHP | `header.php` | Adici??n de enlaces `Proceso`, `Alcance` y `Cobertura`. | Paridad de navegaci??n con Vue. |
| Etiquetas | `header.php` | Cambio de label "Contacto" a "Escribime". | Paridad de copy con Vue. |
| Enlaces | `header.php` | Sincronizaci??n de hashes (#proceso, #tarifas, #cobertura). | Trazabilidad funcional. |

## 9. Validaci??n posterior al cambio

| Criterio de validaci??n | Resultado en WordPress | Comparaci??n con Vue | Estado |
|---|---|---|---|
| Visual desktop | 6 ??tems presentes + CTA "Escribime". | Id??ntico. | OK |
| Visual tablet | 6 ??tems presentes. | Id??ntico. | OK |
| Visual mobile | 6 ??tems presentes en el offcanvas. | Id??ntico. | OK |
| Interacci??n perceptible | Enlaces presentes en el DOM y clicables. | Id??ntico. | OK |
| Regresi??n visible | Sin regresiones en el header. | N/A | OK |


## 10. Evidencia t??cnica utilizada

### Snippet 1
**Objetivo:** Obtener la lista exacta de enlaces en Vue
**Entorno:** Vue
**Elemento o zona inspeccionada:** Navbar links data

```js
// datamaqSiteSnapshot.content.navbar.links
[
  { label: 'Soluci??n', href: '#servicios' },
  { label: 'Proceso', href: '#proceso' },
  { label: 'Alcance', href: '#tarifas' },
  { label: 'Cobertura', href: '#cobertura' },
  { label: 'FAQ', href: '#faq' },
  { label: 'Contacto', href: '#contacto' }
]
```

## 11. Resultado de la microauditor??a

* Estado final: Cerrada
* Resultado: Resuelto
* ## Diferencia residual: Ninguna relevante en el header inicial.
* ## Siguiente microauditor??a sugerida: `home-header-typography.md`

## 12. Registro Git

| Campo | Valor |
| --- | --- |
| Rama | main |
| Estado de Git revisado antes de cambios | S?? |
| Archivos incluidos en commit | `header.php` |
| Mensaje de commit | feat(header): synchronize menu items and labels with Vue |
| Hash de commit | f117e70 |

## 13. Resumen ejecutando

Se han sincronizado los ??tems de navegaci??n de la cabecera para reflejar fielmente la estructura capturada en el snapshot de Vue. Se a??adieron los enlaces `#proceso`, `#tarifas` y `#cobertura` (posteriormente refinados) y se actualiz?? el copy a "Escribime". La microauditor??a cumple con el objetivo de paridad informativa.


