# DEPLOY - Estrategia de Despliegue Híbrido

Este repositorio utiliza un modelo de **Integración Continua (CI) Local** y **Despliegue Continuo (CD) Automatizado** para optimizar el uso de recursos y garantizar la estabilidad del sitio.

## 🏗️ Arquitectura de Despliegue

### 1. CI Local (Validación Pre-Push)
Para maximizar el ahorro de recursos, la validación (L1-L4) ocurre **exclusivamente en local** mediante Git Hooks. GitHub Actions no realiza tareas de validación de código.

### 2. CD en 8 Etapas (GitHub Actions)
El flujo en `.github/workflows/deploy.yml` se activa al hacer push a `main` y se divide en:
- **🔐 Audit Secrets:** Verifica claves privadas.
- **📋 Audit Variables:** Verifica la configuración base.
- **🔍 Audit Host Type:** Detecta si se usa IP o Dominio.
- **🌐 Audit DNS Syntax:** Valida el formato del dominio.
- **🌐 Audit DNS Resolution:** Valida la existencia del dominio en la red.
- **🔑 Audit SSH Auth:** Valida el acceso antes de mover archivos.
- **🚀 Deploy:** Sincroniza archivos vía `rsync`.
- **🏥 Verify:** Flush de caché y Smoke Test final.
1. **Sincronización:** Usa `rsync` para subir solo archivos necesarios, excluyendo tests y configs locales.
2. **Post-Deploy:**
   - **Cache Flush:** Ejecuta `wp cache flush` vía SSH (requiere `wp-cli` en el servidor).
   - **Audit Log:** Crea `deploy-info.json` en la raíz del sitio con el ID del commit y fecha UTC.
3. **Smoke Test:** Un health check final (curl) verifica que el sitio responda con un HTTP 200.

## 🔐 Configuración de GitHub (Secrets & Variables)

Debés cargar estos valores en `Settings > Secrets and variables > Actions`:

### Secrets (Pestaña "Secrets" - Encriptados)
| Secreto | Descripción | Ejemplo |
| :--- | :--- | :--- |
| `SERVER_SSH_KEY` | Clave privada SSH. | `-----BEGIN OPENSSH PRIVATE KEY-----...` |

### Variables (Pestaña "Variables" - Texto Plano)
| Variable | Descripción | Ejemplo |
| :--- | :--- | :--- |
| `REMOTE_HOST` | IP o Dominio del servidor. | `168.181.184.103` |
| `REMOTE_USER` | Usuario SSH. | `root` |
| `REMOTE_PORT` | Puerto SSH (si no es el 22). | `5932` |
| `REMOTE_TARGET` | Ruta absoluta en el servidor. | `/home/datamaq/public_html/` |
| `SITE_URL` | URL pública para el Health Check. | `https://datamaq.com.ar` |

### Procedimiento para generar la Key:
1. En tu terminal local: `ssh-keygen -t ed25519 -f ~/.ssh/id_github_deploy -C "github-actions-deploy"`
2. Copiá la **clave pública** (`~/.ssh/id_github_deploy.pub`) al archivo `~/.ssh/authorized_keys` del servidor.
3. Copiá la **clave privada** (`~/.ssh/id_github_deploy`) al secreto `SERVER_SSH_KEY` en GitHub.

## 📊 Observabilidad en Producción
Podés verificar la salud del despliegue de dos formas:
1. **Logs de GitHub Actions:** Verás el resultado del Smoke Test y el Flush de caché en la pestaña *Actions*.
2. **Fichero de Auditoría:** Visitando `https://datamaq.com.ar/deploy-info.json` para confirmar qué versión del código está realmente activa en el servidor.

## 🔐 Archivos Excluidos
Archivos como `wp-config.php`, `.env` y el núcleo de WordPress se gestionan directamente en el servidor y no forman parte de este flujo de despliegue para mantener el repositorio liviano ("Slim Repo").
