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
- **Patrón:** Arquitectura Hexagonal (Domain, Application, Infrastructure, UI).
- **PHP:** 8.3+.
- **Estándares:** WordPress Coding Standards (WPCS) obligatorios.
- **Análisis Estático:** PHPStan Nivel 3+.
- **Validación Local:** Prohibido hacer `git push` si el `pre-push` hook falla.

## 🚀 Pipeline de Despliegue (CD)
- **Estrategia:** Zero-Cost CI/CD vía GitHub Actions -> VPS (Puerto 5932).

## 🤖 Misión Actual: Consolidación en Chatwoot (COMPLETADA)
- **Estado:** Sistemas legados (Sistemas Legados, Sistemas Legados, Sistemas Legados) totalmente purgados.
- **Canal Único:** Chatwoot centraliza toda la comunicación y captación de leads.
- **Infraestructura:** 
  - `ChatWootLeadRepository`: Sincroniza leads capturados vía REST API.
  - `ChatwootProvider`: Gestiona el widget oficial de Chatwoot.
- **UI:** Intercepción unificada en `index.html` (Debug Gateway) que desvía interacciones (WhatsApp, #chat) hacia Chatwoot.

## 🏥 Observabilidad y Salud
- **Health Check:** `/wp-json/v1/health`.
- **Debug Gateway:** Inyecta logs con estilo en la consola del navegador para trazabilidad de leads.
- **Server Logs:** Uso de `DataMaq\Infrastructure\Shared\WPLogger` con prefijo `[Chatwoot]`.

## ⚠️ Restricciones Críticas
1. **No tocar el Core:** Modificaciones solo en `wp-content/themes/datamaq-theme/` o `index.html`.
2. **Seguridad:** Usar `ConfigProvider` para credenciales.
3. **Slim Repo:** Sin imágenes pesadas ni dependencias fuera de `composer.json`.

## 📂 Estructura de Directorios
- `src/Domain`: Lógica pura del negocio.
- `src/Application`: Servicios y Casos de Uso.
- `src/Infrastructure`: Adaptadores (WordPress, Chatwoot, Loggers).
- `src/UI`: Templates y Lógica de visualización.