# AGENT GUIDELINES - DataMaq Project

Este documento define las reglas operativas, el ciclo de ejecución y el estado técnico estricto para los Agentes de IA que colaboren en este repositorio.

## ⚙️ Ciclo de Ejecución Obligatorio (Workflow)
Todo agente debe seguir este flujo lógico exacto ante cualquier solicitud o tarea:

1. **Análisis Arquitectónico:** Antes de proponer o escribir cualquier línea, la solución debe ser evaluada obligatoriamente bajo los principios de:
   - **Arquitectura Hexagonal** (Aislamiento de capas).
   - **Domain-Driven Design (DDD)** (Modelado fiel al negocio).
   - **Observabilidad** (Trazabilidad y monitoreo).
   - **SOLID** (Diseño orientado a objetos limpio).
2. **Gestión Estricta de Documentación:** Revisar y mantener actualizada *únicamente* la siguiente lista blanca de archivos. **No crear ni mantener documentación adicional** a menos que exista una justificación técnica crítica e irrefutable:
   - `README.md`
   - `AGENT.md`
   - `docs/DISCOVERY.md`
   - `docs/SRS.md`
   - `docs/TODO.md`
3. **Modificación de Código (Regla de Certeza):** El agente *solo* tiene permitido modificar el codebase si posee **total certeza** de la solución y su impacto. Inmediatamente después de modificar el código, se debe actualizar la documentación oficial correspondiente.
4. **Gestión de la Incertidumbre (Regla de Duda):** Si el agente tiene dudas, suposiciones no verificadas o falta de contexto, **NO debe adivinar ni modificar código**. Toda duda, hallazgo preliminar o pregunta debe ser volcada exclusivamente en `docs/DISCOVERY.md`. Este documento está reservado *únicamente* para dudas; cualquier certeza descubierta debe ser distribuida a la documentación oficial y eliminada del discovery.

---

## 🏛️ Arquitectura y Estándares Técnicos
- **Patrón:** Arquitectura Hexagonal (Domain, Application, Infrastructure, UI) guiada por DDD y SOLID.
- **PHP:** 8.3+.
- **Estándares:** WordPress Coding Standards (WPCS) obligatorios.
- **Análisis Estático:** PHPStan Nivel 3+ (Sin errores permitidos en `src/`).
- **Validación Local:** Prohibido hacer `git push` si el `pre-push` hook falla (L1-L4).

## 🚀 Pipeline de Despliegue (CD)
- **Estrategia:** Zero-Cost CI/CD vía GitHub Actions.
- **Jobs (8):** Audit Secrets -> Audit Vars -> Host Detection -> DNS Syntax -> DNS Res -> SSH Auth -> Deploy -> Verify.
- **Servidor:** VPS vía SSH (Puerto 5932).
- **Importante:** No usar `git add .`. Agregar archivos de forma selectiva para evitar trackear el núcleo de WP.

## 🤖 Misión Actual: Integración de BotMan (COMPLETADA)
- **Estado:** Backend operativo (REST API: `/wp-json/datamaq/v1/chat`).
- **Adaptador:** `BotmanAdapter` integrado con `ChatManager`.
- **UI:** Widget inyectado en SPA (Sidecar Pattern) con unificación responsiva para escritorio y móvil.

## 🏥 Observabilidad y Salud
- **Health Check:** `/wp-json/v1/health` (Alias nativo para SPA).
- **Loggers:** Uso obligatorio de `DataMaq\Domain\Shared\Observability\LoggerInterface`.
- **Value Objects:** Las respuestas de salud deben usar `HealthStatus` para garantizar tipado fuerte.

## ⚠️ Restricciones Críticas
1. **No tocar el Core:** No modificar archivos de WordPress fuera de `wp-content/themes/datamaq-theme/`.
2. **Seguridad Absoluta:** Nunca incluir tokens, contraseñas o datos sensibles en el código, ni siquiera en `docs/DISCOVERY.md`. Usar siempre `ConfigProvider`.
3. **Slim Repo:** Mantener el repositorio liviano. No subir imágenes pesadas o dependencias fuera de `composer.json`.

## 📂 Estructura de Directorios (Source)
- `src/Domain`: Entidades, interfaces de motor, value objects y lógica pura del negocio (DDD).
- `src/Application`: Servicios de aplicación y casos de uso.
- `src/Infrastructure`: Adaptadores (WordPress, Botman, Loggers, Config). Implementación de interfaces.
- `src/UI`: Templates y lógica de visualización del tema.