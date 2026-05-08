# Guía de Despliegue - DataMaq

Este proyecto utiliza una estrategia de **Zero-Cost CI/CD** optimizada para WordPress, dividiendo la carga de trabajo entre validaciones locales y despliegue automatizado.

## 🏗️ Arquitectura del Pipeline

### 1. CI Local (Validación Pre-Push)
Para maximizar el ahorro de recursos, la validación (L1-L4) ocurre **exclusivamente en local** mediante Git Hooks (`.githooks/pre-push`). 
- **Detección Inteligente:** Si solo se modifican archivos de documentación o infraestructura (`.github/`, `docs/`, `.md`), el CI se salta para ahorrar tiempo.

### 2. CD en 8 Etapas (GitHub Actions)
El flujo en `.github/workflows/deploy.yml` se activa al hacer push a `main`:
1.  **🔐 Audit Secrets:** Verifica la presencia de claves SSH.
2.  **📋 Audit Variables:** Verifica la configuración del entorno.
3.  **🔍 Audit Host Type:** Detecta si se usa IP o Dominio.
4.  **🌐 Audit DNS Syntax:** Valida el formato del nombre de host.
5.  **🌐 Audit DNS Resolution:** Valida la existencia del dominio en la red.
6.  **🔑 Audit SSH Auth:** Prueba la conexión al servidor (Puerto 5932).
7.  **🚀 Deploy:** Sincroniza archivos vía `rsync` excluyendo el núcleo de WP.
8.  **🏥 Verify:** Limpia la caché (`wp-cli`) y verifica la salud (HTTP 200).

## 🔐 Configuración de GitHub (Environment: prod)

Debés cargar estos valores en `Settings > Environments > prod`:

### Secrets
- `SERVER_SSH_KEY`: Clave privada SSH (Generada con ED25519).

### Variables
| Variable | Valor Recomendado |
| :--- | :--- |
| `REMOTE_HOST` | `168.181.184.103` (o `ssh.datamaq.com.ar` cuando el DNS propague) |
| `REMOTE_USER` | `root` |
| `REMOTE_PORT` | `5932` |
| `REMOTE_TARGET` | `/home/datamaq/public_html/` |
| `SITE_URL` | `https://datamaq.com.ar` |

## 📊 Observabilidad
- Al finalizar el despliegue, se genera un **Summary Report** en la pestaña *Actions* de GitHub.
- Se puede verificar la versión activa visitando `https://datamaq.com.ar/deploy-info.json`.
