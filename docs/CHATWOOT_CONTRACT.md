# Contrato de Integración API: WordPress -> ChatWoot

Este documento define la especificación técnica y las certezas para la integración directa entre WordPress (DataMaq) y ChatWoot.

## 1. Evolución Arquitectónica (El Volantazo)
- **Eliminación de Middleware (n8n)**: Se descartan los webhooks y la triangulación. La latencia mejora y se reducen los puntos de falla externos.
- **Eliminación de SuiteCRM**: Los leads ya no se guardarán en SuiteCRM.
- **Eliminación de ChatMan (BotMan)**: El motor de chatbot local (`ChatbotService`, `BotmanAdapter`) será removido para centralizar la comunicación en ChatWoot.
- **ChatWoot Directo**: La plataforma principal de mensajería y gestión de leads será ChatWoot, utilizando su API de manera nativa sin intermediarios.

## 2. Certezas de Infraestructura y Observabilidad
- **Unificación de Leads:** Tanto el formulario de la SPA como futuros orígenes usan el mismo Use Case en backend (`SubmitLeadUseCase`).
- **Normalización de Loggers:** La observabilidad está centralizada en `WPLogger` (mediante `LoggerInterface`), evitando usar `error_log` de forma desordenada a lo largo del código.
- **Intercepción de SPA:** Existe un "Debug Gateway" en `index.html` que intercepta llamadas de la SPA compilada. Su uso será adaptado a ChatWoot si se requiere.
- **Respeto por el Código Existente**: No se realizarán cambios en los archivos PHP, JS o HTML hasta no agotar las dudas del `DISCOVERY.md`.

## 3. Certezas de Implementación Técnica (Ejecutadas)
1. **Interfaz (Frontend):** Se utiliza el **SDK oficial de Chatwoot** inyectado vía `ChatwootProvider`. 
2. **Control de Apertura:** Se interceptan las interacciones de la SPA y del tema (enlaces `#chat`, botones de WhatsApp) mediante un **Debug Gateway** en `index.html` que dispara `window.$chatwoot.toggle()`.
3. **Entidades en Chatwoot:** El `ChatWootLeadRepository` utiliza la API para buscar/crear contactos y abrir conversaciones automáticas ante cada envío de lead.
4. **Automatización:** La lógica de respuestas se gestiona **100% dentro de Chatwoot**.
5. **Flujo de Datos:** El **`LeadRestController` actúa como Proxy Seguro**, delegando la persistencia al repositorio hexagonal de Chatwoot.

## 4. Definición del Servicio (PHP Interface)

Se ha implementado la siguiente abstracción en la Arquitectura Hexagonal:

- **Puerto:** `LeadRepositoryInterface` (Domain)
- **Adaptador:** `ChatWootLeadRepository` (Infrastructure)

La implementación se apoya en `WPLogger` para garantizar la observabilidad de cada paso de la sincronización con la API REST de Chatwoot.
