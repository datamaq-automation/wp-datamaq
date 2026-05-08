# DEPLOY - Estrategia de Despliegue Híbrido

Este repositorio utiliza un modelo de **Integración Continua (CI) Local** y **Despliegue Continuo (CD) Automatizado** para optimizar el uso de recursos y garantizar la estabilidad del sitio.

## 🏗️ Arquitectura de Despliegue

### 1. CI Local (Validación Pre-Push)
Para ahorrar minutos de GitHub Actions, validamos la calidad antes de subir el código.
- **Hook:** `.githooks/pre-push`
- **Niveles:** L1 (Sintaxis), L2 (WPCS), L3 (PHPStan), L4 (PHPUnit).

### 2. CD Automatizado (GitHub Actions)
El flujo en `.github/workflows/deploy.yml` se activa al hacer push a `main`:
1. **Sincronización:** Usa `rsync` para subir solo archivos necesarios, excluyendo tests y configs locales.
2. **Post-Deploy:**
   - **Cache Flush:** Ejecuta `wp cache flush` vía SSH (requiere `wp-cli` en el servidor).
   - **Audit Log:** Crea `deploy-info.json` en la raíz del sitio con el ID del commit y fecha UTC.
3. **Smoke Test:** Un health check final (curl) verifica que el sitio responda con un HTTP 200.

## 🔐 Configuración de Secretos (GitHub)

Para habilitar el despliegue, debés cargar estos secretos en `Settings > Secrets and variables > Actions`:

| Secreto | Descripción | Ejemplo |
| :--- | :--- | :--- |
| `SERVER_SSH_KEY` | Clave privada SSH (RSA o ED25519). | `-----BEGIN OPENSSH PRIVATE KEY-----...` |
| `REMOTE_HOST` | IP o Dominio del servidor. | `123.45.67.89` o `ssh.datamaq.com.ar` |
| `REMOTE_USER` | Usuario con permisos de escritura. | `agustin` o `deploy-user` |
| `REMOTE_TARGET` | Ruta absoluta de la web en el servidor. | `/var/www/datamaq/public_html/` |

### Procedimiento para generar la Key:
1. En tu terminal local: `ssh-keygen -t ed25519 -C "github-actions-deploy"`
2. Copiá la **clave pública** (`.pub`) al archivo `~/.ssh/authorized_keys` del servidor.
3. Copiá la **clave privada** íntegra al secreto `SERVER_SSH_KEY` en GitHub.

## 📊 Observabilidad en Producción
Podés verificar la salud del despliegue de dos formas:
1. **Logs de GitHub Actions:** Verás el resultado del Smoke Test y el Flush de caché en la pestaña *Actions*.
2. **Fichero de Auditoría:** Visitando `https://datamaq.com.ar/deploy-info.json` para confirmar qué versión del código está realmente activa en el servidor.

## 🔐 Archivos Excluidos
Archivos como `wp-config.php`, `.env` y el núcleo de WordPress se gestionan directamente en el servidor y no forman parte de este flujo de despliegue para mantener el repositorio liviano ("Slim Repo").
