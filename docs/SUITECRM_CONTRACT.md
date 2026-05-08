# Contrato de Integración API: BotMan -> SuiteCRM v8

Este documento define la especificación técnica y el contrato de interfaz para la integración directa entre el Chatbot (DataMaq / WordPress) y el CRM (SuiteCRM), descartando el uso de middleware (n8n).

## 1. Definición del Servicio (PHP Interface)

Para cumplir con el principio de Inversión de Dependencias (SOLID) de nuestra Arquitectura Hexagonal, crearemos un contrato en el Dominio que la Infraestructura deberá cumplir.

```php
namespace DataMaq\Domain\CRM;

interface CrmProviderInterface {
    /**
     * Envía un nuevo Lead al CRM.
     * 
     * @param string $name Nombre del contacto.
     * @param string $contact_info Teléfono o Email proporcionado.
     * @param string $reason El motivo o máquina que necesita.
     * @return bool True si se insertó correctamente, False si falló.
     */
    public function createLead(string $name, string $contact_info, string $reason): bool;
}
```

## 2. Requisitos de Configuración (Entorno)

El servicio requerirá las siguientes variables expuestas a través de `ConfigProvider`:
- `SUITECRM_BASE_URL`: (Ej: `https://crm.datamaq.com.ar`)
- `SUITECRM_CLIENT_ID`: ID del cliente OAuth2 generado en SuiteCRM.
- `SUITECRM_CLIENT_SECRET`: Secreto del cliente OAuth2.

## 3. Flujo HTTP y Endpoints (REST API v8)

### Paso A: Autenticación (OAuth2)
SuiteCRM v8 requiere un Bearer Token válido. El servicio deberá solicitarlo o reutilizar uno en caché.

**Request:**
- **Endpoint:** `POST {SUITECRM_BASE_URL}/Api/access_token`
- **Headers:** `Content-Type: application/vnd.api+json`
- **Body:**
```json
{
  "grant_type": "client_credentials",
  "client_id": "{SUITECRM_CLIENT_ID}",
  "client_secret": "{SUITECRM_CLIENT_SECRET}"
}
```

**Response Expected (200 OK):**
```json
{
  "access_token": "eyJ0eX...",
  "expires_in": 3600,
  "token_type": "Bearer"
}
```

### Paso B: Creación del Lead
Usando el formato estándar de JSON:API que exige SuiteCRM v8.

**Request:**
- **Endpoint:** `POST {SUITECRM_BASE_URL}/Api/V8/module`
- **Headers:** 
  - `Authorization: Bearer {access_token}`
  - `Content-Type: application/vnd.api+json`
  - `Accept: application/vnd.api+json`
- **Body:**
```json
{
  "data": {
    "type": "Leads",
    "attributes": {
      "first_name": "{name}",
      "last_name": "[Generado por BotMan]",
      "phone_work": "{contact_info}",
      "description": "Motivo de contacto: {reason}",
      "lead_source": "Web Chat"
    }
  }
}
```
*(Nota: SuiteCRM normalmente requiere un `last_name`. Si el bot solo pide un nombre genérico, se deberá enviar el string completo en `last_name` o mapear "Cliente DataMaq" si se prioriza `first_name`).*

**Response Expected (201 Created):**
```json
{
  "data": {
    "type": "Leads",
    "id": "12345-abcde-67890-fghij",
    "attributes": {
      ...
    }
  }
}
```

## 4. Manejo de Errores y Resiliencia

- **Timeouts:** Las llamadas cURL / Guzzle tendrán un timeout estricto de 3 segundos para no bloquear el hilo de respuesta de PHP hacia el usuario del chat.
- **Logueo:** Si SuiteCRM devuelve un error (4xx / 5xx), el error exacto será registrado usando `LoggerInterface::error()`, y `createLead()` devolverá `false`. El Chatbot agradecerá al usuario y el equipo técnico revisará los logs.
