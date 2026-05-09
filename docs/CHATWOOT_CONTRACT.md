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

## 3. Definición del Servicio (PHP Interface Esperada)

Se espera implementar la siguiente abstracción en la Arquitectura Hexagonal para aislar a ChatWoot:

```php
namespace DataMaq\Domain\CRM;

interface ChatPlatformProviderInterface {
    /**
     * Registra un Lead y/o mensaje en la plataforma de Chat.
     * 
     * @param array $leadData Datos estructurados del contacto.
     * @return bool True si se procesó correctamente.
     */
    public function captureLead(array $leadData): bool;
}
```

La implementación concreta será `ChatWootAdapter`, responsable de la comunicación HTTP RESTful.
