# AGENT GUIDELINES - DataMaq Project

Este documento define las reglas operativas y el estado técnico para los Agentes de IA que colaboren en este repositorio.

## 🏛️ Arquitectura y Estándares
- **Patrón:** Arquitectura Hexagonal (Domain, Application, Infrastructure, UI).
- **PHP:** 8.3+.
- **Estándares:** WordPress Coding Standards (WPCS) obligatorios.
- **Análisis Estático:** PHPStan Nivel 3+ (Sin errores permitidos en `src/`).
- **Validación Local:** Prohibido hacer `git push` si el `pre-push` hook falla (L1-L4).

## 🚀 Pipeline de Despliegue (CD)
- **Estrategia:** Zero-Cost CI/CD vía GitHub Actions.
- **Jobs (8):** Audit Secrets -> Audit Vars -> Host Detection -> DNS Syntax -> DNS Res -> SSH Auth -> Deploy -> Verify.
- **Servidor:** VPS vía SSH (Puerto 5932).
- **Importante:** No usar `git add .`. Agregar archivos de forma selectiva para evitar trackear el núcleo de WP.

## 🤖 Misión Actual: Integración de BotMan
- **Estado:** Backend operativo (REST API: `/wp-json/datamaq/v1/chat`).
- **Adaptador:** `BotmanAdapter` actualizado para usar `LoggerInterface` unificado.
- **UI:** Widget nativo PHP/JS en desarrollo.

## 🏥 Observabilidad y Salud (NUEVO)
- **Health Check:** `/wp-json/v1/health` (Alias nativo para SPA).
- **Loggers:** Uso obligatorio de `DataMaq\Domain\Shared\Observability\LoggerInterface`.
- **Value Objects:** Las respuestas de salud deben usar `HealthStatus` para garantizar tipado fuerte.

## ⚠️ Restricciones Críticas
1. **No tocar el Core:** No modificar archivos de WordPress fuera de `wp-content/themes/datamaq-theme/`.
2. **Seguridad:** Nunca incluir tokens o contraseñas en el código o documentación. Usar `ConfigProvider`.
3. **Slim Repo:** Mantener el repositorio liviano. No subir imágenes pesadas o dependencias fuera de `composer.json`.

## 📂 Estructura de Directorios (Source)
- `src/Domain`: Entidades, interfaces de motor y lógica pura.
- `src/Application`: Servicios de aplicación y casos de uso.
- `src/Infrastructure`: Adaptadores (WordPress, Botman, Loggers, Config).
- `src/UI`: Templates y lógica de visualización del tema.
