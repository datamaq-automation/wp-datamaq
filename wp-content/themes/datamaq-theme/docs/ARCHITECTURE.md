# DataMaq Theme - Arquitectura Técnica

Este tema ha sido diseñado siguiendo los principios de **Clean Architecture**, **SOLID** y **Domain-Driven Design (DDD)**, eliminando la deuda técnica de temas monolíticos tradicionales.

## 1. Capas del Sistema (src/)

El código se organiza en cuatro capas fundamentales para asegurar el desacoplamiento total:

### Domain (Dominio)
La lógica pura de negocio. No depende de WordPress ni de librerías externas.
- **Entities**: Objetos de negocio (ej. `LeadEntity`).
- **Interfaces**: Contratos para repositorios y servicios.
- **Exceptions**: Excepciones específicas del negocio.

### Application (Aplicación)
Orquesta el flujo de datos desde y hacia la capa de dominio.
- **Use Cases**: Acciones atómicas del sistema (ej. `SubmitLeadUseCase`).

### Infrastructure (Infraestructura)
Implementaciones concretas de los contratos del dominio que interactúan con WordPress o servicios externos.
- **Persistence**: Repositorios de datos (`StaticContentRepository`).
- **Services**: Envío de emails, integración directa con ChatWoot, SEO.

### UI (Interfaz de Usuario)
Maneja la entrada del usuario y la presentación.
- **Controllers**: Manejan peticiones AJAX/REST.
- **ViewModels**: Preparan los datos para los templates de PHP.

## 2. Patrones Implementados

- **Repository Pattern**: Permite cambiar la fuente de datos (Array, DB, API) sin modificar los templates.
- **ViewModel Pattern**: Las plantillas de PHP (`template-parts/`) son puramente declarativas.
- **Dependency Injection (Manual)**: Los controladores instancian sus dependencias, permitiendo una futura migración a un contenedor DI.
- **JS Componentizer**: Arquitectura modular para el frontend sin necesidad de frameworks pesados.

## 3. Arquitectura de Chat y CRM (ChatWoot)

- **Domain (`LeadRepositoryInterface.php`)**: Contrato que define la persistencia de leads.
- **Infrastructure (`ChatWootLeadRepository.php`)**: Implementación que se comunica con la API de Chatwoot.
- **Sidecar Pattern (SPA)**: Debido a que la web es una SPA compilada (Vue), la unificación del chat se realiza mediante un **Debug Gateway** en `index.html` que intercepta clics y llamadas de red, disparando el widget oficial de Chatwoot (`window.$chatwoot.toggle()`) y redirigiendo los leads al backend de WordPress.

## 4. Integraciones

- **ChatWoot**: Gestión omnicanal de leads y mensajería mediante integración directa por API REST.
- **SEO Técnico**: Generación dinámica de JSON-LD y metadatos de alta calidad.

## 5. Guía de Mantenimiento

Para añadir una nueva sección:
1. Definir los datos en `inc/site-data.php`.
2. Crear un `ViewModel` en `src/UI/ViewModels/`.
3. Crear la plantilla en `template-parts/` usando el ViewModel.
4. (Opcional) Añadir un componente JS en `assets/js/components/` si requiere interactividad.
5. (Para el Chat) Configurar las reglas de automatización directamente en el panel de ChatWoot.
