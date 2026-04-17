# Certezas y dudas para la réplica Vue -> WordPress

## Certezas nuevas
- El WordPress del VPS está en /home/datamaq/public_html/cursos.
- El tema activo del VPS es Blocksy.
- El sitio de WordPress se llama DataMaq.
- La portada frontal del WordPress está asignada a la página 205 con slug datamaq-home.
- La portada frontal usa la plantilla de página por defecto; no hay ront-page.php propio en Blocksy dentro del sitio.
- La página 205 contiene la home como contenido Gutenberg, no como una SPA Vue en runtime.
- La home WP ya incluye hero, perfil técnico y servicios en bloques editables.
- La home WP reutiliza la misma narrativa del Vue: captura automática de datos, IoT, energía, producción, instalación, análisis y capacitaciones.
- El WP del VPS no tiene CSS de home propio detectado en Blocksy para esas clases de contenido; la personalización visible depende del theme base, de los bloques y de estilos existentes del sitio.
- No hay una hoja de estilos custom del theme detectada para la home mediante custom_css_post_id; el valor está vacío (-1).
- El repo local C:\AppServ\www\plantilla-www tiene documentación explícita de una migración a WordPress nativo.
- Esa documentación local define como objetivo un tema PHP nativo y la preservación de URLs, SEO y redirecciones.
- El WordPress del VPS tiene wp-cli disponible.
- El WordPress del VPS tiene mu-plugins activos para ajustes de comportamiento y compatibilidad.
- El theme Blocksy del VPS está personalizado y opera sobre la instalación existente.

## Certezas de contenido
- La marca es DataMaq.
- La base operativa es Garín (GBA Norte).
- El contacto principal es WhatsApp.
- La propuesta comunica instalación e integración de equipos IoT para energía y producción.
- La home Vue y la home WP comparten la misma narrativa comercial y técnica.
- La réplica no parte de cero: ya hay una versión WordPress que recoge buena parte del contenido y la estructura del Vue.

## Ruta técnica más probable
- La vía más sensata para seguir es ajustar PHP y CSS sobre la base actual del WordPress.
- Blocksy sirve como base funcional, pero no como destino visual final si se busca máxima fidelidad.
- La home actual de WordPress ya es una base válida para refinar la réplica sección por sección.

## Propuesta concreta de cambios
### style.css
- Crear un child theme o stylesheet propio para no editar Blocksy directamente.
- Aplicar estilos a ody.page-id-205 y a una envoltura propia, por ejemplo .dm-home.
- Reproducir la lógica visual del Vue con:
  - fondo degradado oscuro con halo radial;
  - header sticky translúcido;
  - hero en dos columnas con tarjeta de imagen y CTA;
  - cards de servicios con borde superior acento;
  - bloques de perfil, FAQ y footer con paneles redondeados;
  - dock inferior móvil y espaciados amplios.
- Mantener la paleta, el radio, la sombra y los anchos de lectura del Vue.

### Plantilla
- Crear ront-page.php en un child theme para controlar la portada estática.
- Dentro de esa plantilla, renderizar el contenido de la página 205 y envolverlo en una clase tipo .dm-home.
- Si hace falta más control, mover la home a una plantilla parcial dedicada para el hero y secciones visibles.
- Dejar page.php de Blocksy como fallback para el resto de páginas.

## Dudas que siguen abiertas
- No está confirmado si la home WP ya está completa o si aún faltan secciones, estilos o microajustes visuales.
- No está confirmado si querés replicar sólo la home o también páginas internas equivalentes del Vue.
- No está confirmado si la réplica debe mantenerse administrable desde Gutenberg o si conviene pasar más estructura a plantilla PHP fija.
- No está confirmado si LearnPress sigue siendo parte del alcance funcional del sitio final o sólo contenido legado.
- No está confirmado si querés mantener Blocksy como base definitiva o migrar luego a un tema hijo propio.
- No está confirmado si la prioridad es fidelidad visual máxima o velocidad de entrega con buena similitud.
- No está confirmado si preferís que la home final siga siendo editable por bloques o si aceptás una home más rígida para ganar control visual.

## Próximo paso lógico
- Implementar un child theme o stylesheet propio y mover allí los estilos de la home, manteniendo la página 205 como fuente de contenido.
