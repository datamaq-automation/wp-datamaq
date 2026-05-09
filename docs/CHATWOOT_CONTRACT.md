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

## 3. Certezas de Implementación Técnica (Definidas)
Tras el proceso de Discovery, se han tomado las siguientes decisiones finales:

1. **Interfaz (Frontend):** Se **mantiene la SPA actual** (diseño personalizado). No se usará el widget oficial de ChatWoot para no romper la estética premium.
2. **Entidades en ChatWoot:** Se utilizará la API para **Crear/Actualizar Contacto** y **Abrir una Conversación** por cada lead enviado.
3. **Automatización:** La lógica de respuestas, saludos y derivaciones se gestionará **100% dentro de ChatWoot** (AgentBots / Automation Rules).
4. **Gestión de Credenciales:** Se implementará una **Página de Ajustes en WordPress** para gestionar el Account ID, Inbox ID y Access Token de forma dinámica.
5. **Flujo de Datos:** El **`LeadRestController` actuará como Proxy Seguro**. Recibirá los datos de la SPA y hará la llamada HTTP a ChatWoot desde el servidor para proteger los tokens de acceso.

## 4. Definición del Servicio (PHP Interface)

Se implementará la siguiente abstracción en la Arquitectura Hexagonal:

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
