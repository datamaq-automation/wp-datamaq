# Contrato de Integración API: WordPress -> ChatWoot

Este documento define la especificación técnica y las certezas para la integración directa entre WordPress (DataMaq) y ChatWoot.

## 1. Evolución Arquitectónica (El Volantazo)
- **Eliminación de Middleware (Sistemas Legados)**: Se descartan los webhooks y la triangulación. La latencia mejora y se reducen los puntos de falla externos.
- **Eliminación de Sistemas Legados**: Los leads ya no se guardarán en Sistemas Legados.
- **Eliminación de sistemas legados (Sistemas Legados)**: El motor de chatbot local será removido para centralizar la comunicación en Chatwoot.
- **ChatWoot Directo**: La plataforma principal de mensajería y gestión de leads será ChatWoot, utilizando su API de manera nativa sin intermediarios.

## 2. Certezas de Infraestructura y Observabilidad
- **Unificación de Leads:** Tanto el formulario de la SPA como futuros orígenes usan el mismo Use Case en backend (`SubmitLeadUseCase`).
- **Normalización de Loggers:** La observabilidad está centralizada en `WPLogger` (mediante `LoggerInterface`), evitando usar `error_log` de forma desordenada a lo largo del código.
- **Intercepción de SPA:** Existe un "Debug Gateway" en `index.html` que intercepta llamadas de la SPA compilada. Su uso será adaptado a ChatWoot si se requiere.
- **Respeto por el Código Existente**: No se realizarán cambios en los archivos PHP, JS o HTML hasta no agotar las dudas del `DISCOVERY.md`.

3. **Certezas de Implementación Técnica (Ejecutadas)**
1. **Interfaz (Frontend):** Se utiliza el **SDK oficial de Chatwoot** inyectado y orquestado por `datamaq-gateway.js`.
2. **Control de Apertura:** Se interceptan las interacciones de la SPA y del tema (enlaces `#chat`, botones de WhatsApp) mediante un **NetworkInterceptor** y un **DOMSentinel**.
3. **Persistencia de Leads (Backend):** El `ChatWootLeadRepository` se enfoca en la **Sincronización de Contactos**. No se crean conversaciones automáticas para evitar ruido en la Inbox.
4. **Mapeo de Datos (E.164 & Flat):** 
    - Los teléfonos se sanitizan al formato estricto E.164.
    - Los metadatos se envían como `custom_attributes` planos (sin anidamiento).
    - Se incluye el booleano `whatsapp_preferred` para segmentación visual en el panel.
5. **Proxy Seguro:** El **`LeadRestController` actúa como punto de entrada único**, inyectando trazabilidad (`traceId`) y validando la identidad de la SPA mediante el header `X-DataMaq-Secret`.
6. **Configuración Dinámica:** El frontend obtiene su configuración (Tokens, URLs) dinámicamente mediante el endpoint `/wp-json/datamaq/v1/config` para evitar hardcodeos y facilitar la portabilidad entre entornos.

## 4. Definición del Servicio (PHP Interface)

Se ha implementado la siguiente abstracción en la Arquitectura Hexagonal:

- **Puerto:** `LeadRepositoryInterface` (Domain)
- **Adaptador:** `ChatWootLeadRepository` (Infrastructure)

La implementación se apoya en `WPLogger` para garantizar la observabilidad de cada paso de la sincronización con la API REST de Chatwoot.
