# DataMaq - TODO List

## 🟢 Prioridad Alta (Technical Debt & Fixes)
- [ ] **UI Polish**: Migrar estilos inline de `content-hero.php` a `style.css`.
- [ ] **UI Polish**: Migrar estilos inline de `content-services.php` a `style.css`.
- [ ] **Normalizaci&oacute;n**: Verificar que no queden referencias a `https://datamaq.com.ar` en archivos `.php` o `.css` (usar `get_stylesheet_directory_uri()`).
- [ ] **Accesibilidad**: Aumentar el contraste o tama&ntilde;o de fuente en el dock m&oacute;vil (actualmente 9px).

## 🟡 Prioridad Media (Mantenimiento)
- [ ] **Im&aacute;genes**: Optimizar `alt` tags en `content-hero.php` para SEO.
- [ ] **CSS**: Consolidar clases duplicadas entre `c-home-eyebrow` y `dm-eyebrow`.
- [ ] **Componentes**: Extraer el wizard de contacto de `content-contact.php` a un archivo JS independiente si crece la l&oacute;gica.

## 🔵 Prioridad Baja (Nuevas Funcionalidades)
- [ ] **Analytics**: Integrar Google Tag Manager (si aplica).
- [ ] **Chat**: Refinar la integraci&oacute;n de Chatwoot para evitar bloqueos de CSP en navegadores estrictos.

## ✅ Completado
- [x] Correcci&oacute;n de scroll (App Shell restriction removal).
- [x] Normalizaci&oacute;n de encoding (`??` fix).
- [x] Aria-label en men&uacute; m&oacute;vil.
- [x] Remoci&oacute;n de URLs de producci&oacute;n en mu-plugins.
