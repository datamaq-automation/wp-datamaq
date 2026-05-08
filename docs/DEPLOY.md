# DEPLOY - Estrategia de Despliegue Híbrido

Este repositorio utiliza un modelo de **Integración Continua (CI) Local** y **Despliegue Continuo (CD) Automatizado** para optimizar el uso de recursos y garantizar la estabilidad del sitio.

## 🏗️ Arquitectura de Despliegue

### 1. CI Híbrido (Doble Validación)
Para garantizar la máxima estabilidad, validamos el código en dos etapas:
- **Etapa Local (Pre-Push):** Ejecuta L1-L4 mediante Git Hooks localmente.
- **Etapa Nube (Paralela):** El pipeline de GitHub lanza tres procesos en paralelo para una respuesta rápida:
  - **🎨 Lint:** Verifica WPCS y sintaxis PHP.
  - **🧠 Analysis:** Ejecuta PHPStan para análisis lógico.
  - **🧪 Test:** Ejecuta PHPUnit para validación funcional.

### 2. CD Automatizado (Job Orquestador)
El job `deploy` actúa como orquestador y solo se inicia si los tres jobs de validación anteriores (`lint`, `analysis` y `test`) terminan en éxito.
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
| `REMOTE_HOST` | IP o Dominio del servidor. | `123.45.67.89` |
| `REMOTE_USER` | Usuario SSH. | `agustin` |
| `REMOTE_PORT` | Puerto SSH (si no es el 22). | `5932` |
| `REMOTE_TARGET` | Ruta absoluta en el servidor. | `/var/www/public_html/` |
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
