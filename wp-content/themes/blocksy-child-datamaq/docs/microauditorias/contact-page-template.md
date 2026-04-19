# Microauditor??a: Contact ??? Page Template (MA-013)

## 1. Ficha de microauditor??a

| Campo | Valor |
|---|---|
| Commit de cierre | ee05792 |
| ID | MA-013 |
| Archivo | docs/microauditorias/contact-page-template.md |
| Estado | Cerrada (Resuelto) |
| Prioridad | Alta |
| Fecha de inicio | 2026-04-19 |
| Usuario responsable | Antigravity |

## 2. Descripci??n de la diferencia

*   **Referencia (Vue)**: La p??gina `/contact` usa `ContactPage.vue` con una cabecera simplificada, un fondo de degradado radial espec??fico y paneles de glassmorphism independientes.
*   **Estado actual (WordPress)**: La p??gina de contacto utiliza el template por defecto y el shortcode `[datamaq_contact_form]` que carga el estilo de la home, el cual no coincide con la versi??n espec??fica de la p??gina de contacto de Vue.

## 3. Objetivo de la microauditor??a

*   Crear el archivo de template `page-contact.php`.
*   Implementar la cabecera simplificada (Marca + Enlace "Inicio").
*   Configurar la estructura de "Contact Shell" (Degradados y fondo).

## 4. Investigaci??n t??cnica

*   **Vue Shell**: `app-shell--contact` con `radial-gradient(circle at top right, rgba(var(--dm-accent-orange-rgb), 0.14), transparent 24%)`.
*   **Header**: `c-contact-page-header`.
*   **Footer**: `c-contact-page-footer`.

## 5. Plan de acci??n

1.  Crear `page-contact.php` en el directorio ra??z del child theme.
2.  Definir el encabezado del template (`Template Name: Contact Page`).
3.  Implementar la l??gica de carga de datos desde `inc/site-data.php`.
4.  Inyectar el layout HTML basado en `ContactPage.vue`.

## 6. Registro de cambios (En curso)

- `[ ]` Creaci??n de `page-contact.php`.
- `[ ]` Inyecci??n de estilos de "Contact Shell".
- `[ ]` Verificaci??n visual inicial.
