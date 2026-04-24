# Auditoria produccion AlmaLinux - 2026-04-24

## Alcance

Auditoria de solo lectura sobre WordPress productivo, salvo rotacion de `WP_CACHE_KEY_SALT` en `wp-config.php`.

## Ubicacion real

- Ruta real de WordPress: `/home/datamaq/public_html`
- La ruta documentada `/home/datamaq/public_html/cursos` no existe en este VPS.
- `siteurl`: `https://datamaq.com.ar`
- Tema activo: `blocksy-child-datamaq` 4.0.0
- Parent theme: `blocksy`

## Seguridad

- `WP_CACHE_KEY_SALT` productivo coincidia con el valor versionado en `wp-config.example.php`.
- Se roto `WP_CACHE_KEY_SALT` en `/home/datamaq/public_html/wp-config.php`.
- Verificacion posterior: `php -l` sin errores y `wp option get siteurl` responde correctamente.
- `wp-config.php` no esta versionado.
- `wp-config.example.php` si esta versionado; el salt real detectado fue reemplazado por placeholder.
- Existen backups de configuracion en document root:
  - `/home/datamaq/public_html/wp-config.php.bak-2026-04-09-101224`
  - `/home/datamaq/public_html/wp-config.php.bak-2026-04-09-103502-wpsc`
- Acceso HTTP probado: ambos backups responden `403` via Cloudflare; aun asi conviene moverlos fuera del document root.

## Git y deploy

- Repo productivo: `git@github.com-wp-cursos:AgustinMadygraf/wp-cursos.git`
- Rama: `main`
- HEAD: `34a28fd feat(child-theme): implement V6 App Shell and refine contact/footer templates`
- Hay cambios no commiteados en produccion:
  - staged: `assets/fonts/inter-var.woff2`, `inc/theme-setup.php`, `style.css`
  - unstaged: `footer.php`, `inc/theme-setup.php`, `style.css`, `template-parts/content-hero.php`

## Plugins activos

- `blocksy-companion` 2.1.38
- `classic-editor` 1.6.7
- `google-site-kit` 1.176.0, update disponible
- `learnpress` 4.3.5
- `microsoft-clarity` 0.10.22, update disponible
- `wordfence` 8.1.4
- `wp-consent-api` 2.0.1
- `wp-super-cache` 3.1.0

Must-use plugins activos:

- `datamaq-design-system`
- `datamaq-disable-comments`
- `datamaq-learnpress-item-links`
- `datamaq-legacy-route-redirects`
- `datamaq-mobile-dock`
- `datamaq-spanish-overrides`

Drop-in:

- `advanced-cache.php`

## DB y contenido

- Portada: `page_on_front = 205`, `show_on_front = page`
- Pagina 205:
  - titulo: `Inicio`
  - slug: `datamaq-home`
  - estado: `publish`
  - `post_content`: vacio
  - metadata: solo `_edit_lock`
- Conclusion: la home productiva usa la DB como contenedor de routing; el contenido visible esta en el tema, no en la DB.

## ACF y CPT

- ACF no esta activo.
- No se encontraron posts `acf-field-group` ni `acf-field`.
- No se encontraron tablas con `%acf%`.
- CPTs publicos registrados por negocio/contenido:
  - WordPress core: `post`, `page`, `attachment`
  - LearnPress: `lp_course`, `lp_lesson`, `lp_quiz`, `lp_question`
- No hay CPTs propios para servicios, procesos, FAQ o contenido de la home.

Conteos relevantes:

- `lp_course`: 3 publicados, 2 auto-draft
- `lp_lesson`: 43 publicados
- `lp_quiz`: 9 publicados
- `lp_question`: 27 publicados
- `page`: 9 publicadas, 1 draft
- `attachment`: 10

## Integraciones

- Chatwoot:
  - script en `functions.php`
  - base URL: `https://chatwoot.datamaq.com.ar`
  - prueba HTTP `HEAD /`: `200`
- n8n:
  - webhook configurado: `https://n8n.datamaq.com.ar/webhook/contact-form`
  - prueba HTTP `HEAD`: `404`, compatible con endpoint que solo acepta `POST`; no verifica flujo end-to-end.
- Email:
  - destino configurado: `info@datamaq.com.ar`
  - envio via `wp_mail()`
  - no se hizo envio real de prueba.
- AJAX contact:
  - acciones: `wp_ajax_submit_contact`, `wp_ajax_nopriv_submit_contact`
  - valida nonce y email.
  - captura `cf-turnstile-response`, pero no se observa verificacion server-side contra Cloudflare Turnstile.
  - no se observa rate limiting propio.
  - el POST a n8n es no bloqueante y no registra fallos.

## Riesgos y recomendaciones inmediatas

1. Purgar historial de Git si el secret expuesto estuvo publicado fuera de este servidor.
2. Mover backups `wp-config.php.bak-*` fuera del document root o eliminarlos tras backup seguro.
3. Preservar y commitear intencionalmente los cambios vivos del tema antes de cualquier deploy.
4. Definir fuente de verdad: hoy la home manda desde Git/PHP, no desde wp-admin.
5. Agregar verificacion server-side de Turnstile y rate limiting al handler AJAX.
6. Hacer prueba controlada de email y POST n8n con trazabilidad, idealmente con un lead marcado como test.
