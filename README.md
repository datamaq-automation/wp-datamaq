# DataMaq WordPress - Technical Repository

Este repositorio contiene la implementación nativa en WordPress para el sitio de DataMaq, optimizado para rendimiento y fidelidad visual respecto a su versión original en Vue.

## 🚀 Arquitectura
- **Core:** WordPress (gestionado localmente).
- **Theme:** `datamaq-theme` (Tema personalizado, arquitectura modular y hexagonal).
- **CRM Integration:** Integración directa con SuiteCRM v8 (OAuth2) para todos los leads.
- **Bot:** Asistente conversacional nativo en PHP (BotMan).
- **Design:** Sistema de diseño basado en Design Tokens y CSS Vanilla.
- **Integración:** Equipos IoT para energía y producción.

## 📁 Estructura de Documentación
Para una gestión limpia, la documentación técnica se divide en los siguientes archivos dentro de la carpeta `/docs`:

1. [**DISCOVERY.md**](docs/DISCOVERY.md): Hallazgos técnicos, estado actual del codebase y auditorías de infraestructura.
2. [**SRS.md**](docs/SRS.md): Especificación de Requisitos de Software, guías de diseño y estándares de contraste.
3. [**TODO.md**](docs/TODO.md): Roadmap de desarrollo, tareas pendientes y backlog de optimización.
4. [**DEPLOY.md**](docs/DEPLOY.md): Guía de despliegue para el repositorio optimizado (Slim Repo).

## 🛠️ Comandos Útiles
Si tenés `wp-cli` instalado:
```bash
# Verificar estado del tema
wp theme list --status=active

# Limpiar caché de estilos (si aplica)
wp transient delete --all
```

## 🚀 Configuración del Entorno
Para activar las validaciones automáticas antes de cada `push`, ejecutá el siguiente comando en la raíz del proyecto:
```bash
git config core.hooksPath .githooks
chmod +x .githooks/pre-push
```
Esto habilitará el **CI Local** (L1: PHP Lint) en tu máquina.

---
*Este repositorio está en proceso de optimización ("Slimming"). Consultar [TODO.md](docs/TODO.md) para detalles sobre la remoción del núcleo de WP del control de versiones.*
