# DEPLOY - Estrategia de Despliegue Híbrido

Este repositorio utiliza un modelo de **Integración Continua (CI) Local** y **Despliegue Continuo (CD) Automatizado** para optimizar el uso de recursos y garantizar la estabilidad del sitio.

## 🛠️ Arquitectura de Despliegue

### 0. Restauración del Core (Si se eliminó para limpieza)
Si el núcleo de WordPress (`wp-admin`, `wp-includes`, etc.) fue eliminado para limpiar el entorno, podés restaurarlo sin afectar tu código custom:
```bash
wp core download --locale=es_ES --skip-content --force
```

### 1. CI Local (Niveles de Validación)
Para garantizar la estabilidad sin consumir créditos de GitHub, utilizamos un sistema de validación progresivo ejecutado mediante Git Hooks (`.githooks/pre-push`).

| Nivel | Validación | Herramienta | Estado |
| :--- | :--- | :--- | :--- |
| **L1** | **Sintaxis** | `php -l` | ✅ Activo |
| **L2** | **Estándares (WPCS)** | `phpcs` | ✅ Activo |
| **L3** | **Análisis Estático** | `phpstan` | ✅ Activo |
| **L4** | **Tests Funcionales** | `phpunit` | ✅ Activo |

- **L1 (Sintaxis):** Detecta errores fatales y puntos y coma faltantes. Es el guardián básico para evitar caídas del sitio.
- **L2 (Estándares):** Asegura que el código siga las normas oficiales de WordPress, mejorando la mantenibilidad.
- **L3 (Estático):** Encuentra errores lógicos complejos sin ejecutar el código (ej: variables no definidas).
- **L4 (Funcional):** Valida que la lógica de negocio (ViewModels, Repositorios) funcione correctamente ante cambios.

### 2. CD Automatizado (GitHub Actions + SSH)
Una vez que el código es aceptado en la rama principal (`main`), se dispara el flujo automático.
- **Conexión:** SSH mediante clave privada (almacenada en GitHub Secrets).
- **Sincronización:** Solo se despliegan los archivos trackeados (Slim Repo).
- **Post-Deploy:** Ejecución de comandos automáticos vía `wp-cli` (limpieza de caché, actualización de base de datos si fuera necesario).

## 📋 Requisitos Previos
- **Local:** Tener configurado el Git Hook en `.githooks/pre-push`.
- **Servidor:** Acceso SSH habilitado y `wp-cli` instalado.
- **GitHub:** Secrets configurados (`SSH_PRIVATE_KEY`, `SSH_HOST`, `SSH_USER`).

## 🚀 Flujo de Trabajo Operativo
1. **Desarrollo:** Realizar cambios en el tema o plugins custom.
2. **Commit & Push:** Al ejecutar `git push`, el sistema corre el CI local.
3. **Validación:** Si el CI local falla, el push se detiene. Si tiene éxito, el código sube a GitHub.
4. **Deploy:** GitHub Actions detecta el push en `main`, se conecta al servidor y sincroniza los archivos.
5. **Finalización:** La Action ejecuta `wp transient delete --all` para asegurar que los ViewModels reflejen los cambios inmediatamente.

## 🔐 Archivos Excluidos
Archivos como `wp-config.php`, `.env` y el núcleo de WordPress se gestionan directamente en el servidor y no forman parte de este flujo de despliegue.
