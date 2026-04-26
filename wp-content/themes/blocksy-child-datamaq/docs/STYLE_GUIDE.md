# DataMaq - Style Guide & Tokens

## 🎨 Paleta de Colores
| Token | Valor Hex/RGB | Uso |
| :--- | :--- | :--- |
| **App Background** | `#03041a` | Fondo exterior del App Shell. |
| **Shell Background** | `#0c092f` | Fondo principal del contenedor. |
| **Accent Orange** | `#ff6a00` | Botones primary, eyebrows, acentos. |
| **Data Cyan** | `#22d3ee` | Glows ambientales, acentos secundarios. |
| **Glass Card** | `rgba(255,255,255,0.03)` | Tarjetas y contenedores con blur. |

## Typography
- **Font Family**: `Inter`, sans-serif (Variable).
- **Headings (`h1`, `h2`)**: `font-weight: 900`, `letter-spacing: -0.05em`, `line-height: 0.9`.
- **Eyebrows**: `font-weight: 900`, `text-transform: uppercase`, `letter-spacing: 0.14em`, color naranja.

## 🧱 Componentes Core (BEM)
- `.dm-app-shell`: Contenedor principal.
- `.c-home-hero`: Secci&oacute;n hero.
- `.c-home-service-card`: Tarjetas de servicios.
- `.dm-btn-cta`: Bot&oacute;n de acci&oacute;n principal.
- `.c-logo-icon`: El icono de c&oacute;digo `>_` de la marca.

## 📏 Espaciado y Radios
- **Bordes**: `var(--dm-radius-huge)` = `4rem` (64px) para el Shell y tarjetas grandes.
- **Radios Botones**: `12px`.
- **Sticky Header**: `72px` (Desktop), `64px` (Mobile).
