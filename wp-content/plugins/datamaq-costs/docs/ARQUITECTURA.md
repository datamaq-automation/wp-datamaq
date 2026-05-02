# Arquitectura del Plugin - Datamaq Costs

Este plugin sigue los principios de **Arquitectura Limpia (Clean Architecture)** y **Diseño Orientado al Dominio (DDD)** para asegurar mantenibilidad y escalabilidad.

## Estructura de Carpetas (`src/`)

### 1. Domain (Dominio)
*   **Propósito:** Contiene la lógica de negocio pura, entidades y objetos de valor.
*   **Contenido:** Clases como `Budget`, `CostItem` o interfaces de repositorios.
*   *Nota: No debe tener dependencias de WordPress ni de APIs externas.*

### 2. Application (Aplicación)
*   **Propósito:** Orquestra el flujo de datos entre el dominio y el mundo exterior.
*   **Contenido:** Servicios como `CostCalculatorService` o casos de uso como `GenerateQuote`.

### 3. Infrastructure (Infraestructura)
*   **Propósito:** Implementaciones técnicas y detalles de frameworks.
*   **Subcapas:**
    *   **External:** Clientes para APIs de terceros (ej: `GoogleMapsClient`).
    *   **UI:** Todo lo relacionado con la interfaz de usuario.
        *   **Admin:** Paneles y ajustes del backend de WordPress.
        *   **Frontend:** Formularios, shortcodes y scripts para el cliente.
    *   **Persistence:** Repositorios que guardan datos en la DB de WordPress.

## Flujo de Datos
Un formulario en la **UI** envía datos a un servicio de la capa de **Application**. Este servicio utiliza un cliente de **Infrastructure** (Google Maps) para obtener datos y los procesa usando reglas de negocio definidas en el **Domain**.
