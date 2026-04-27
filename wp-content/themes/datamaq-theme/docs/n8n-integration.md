# Especificación Técnica: Integración WordPress -> n8n

Este documento define el contrato de integración para el sistema de captura de Leads del tema DataMaq.

## 1. Endpoint del Webhook
- **URL por defecto**: `https://n8n.datamaq.com.ar/webhook/contact-form`
- **Configuración en WordPress**: la URL puede cambiarse desde `Ajustes -> n8n Integration` mediante la opción `dm_n8n_webhook_url`.
- **Método HTTP**: `POST`
- **Content-Type**: `application/json`
- **Autenticación actual**: sin cabeceras de autenticación.

## 2. Estructura del Payload (JSON)
WordPress enviará siempre el siguiente esquema de datos:

```json
{
  "source": "datamaq_wp_theme",
  "timestamp": "ISO8601_TIMESTAMP",
  "data": {
    "name": "Nombre del contacto",
    "email": "usuario@ejemplo.com",
    "phone": "+54911...",
    "company": "Empresa opcional",
    "message": "Cuerpo del mensaje o detalles del proyecto",
    "channel": "whatsapp" | "email"
  }
}
```

### Mapeo desde WordPress
El payload se construye en `DataMaq\Infrastructure\Lead\N8nLeadRepository` a partir de `LeadEntity`.

| Campo JSON | Origen en WordPress | Observaciones |
| --- | --- | --- |
| `source` | Valor fijo | Siempre `datamaq_wp_theme`. |
| `timestamp` | Servidor WordPress | Formato ISO 8601 generado con `date('c')`. |
| `data.name` | `LeadEntity::getName()` | Campo mínimo recomendado para validar en n8n. |
| `data.email` | `LeadEntity::getEmail()` | Puede estar vacío si el lead incluye teléfono. |
| `data.phone` | `LeadEntity::getPhone()` | Puede estar vacío. |
| `data.company` | `LeadEntity::toArray()['company']` | Opcional. |
| `data.message` | `LeadEntity::toArray()['message']` | Opcional. |
| `data.channel` | `LeadEntity::toArray()['channel']` | Se normaliza a `whatsapp` o `email`; cualquier otro valor se envía como `email`. |

## 3. Comportamiento y Errores
- **Asincronía**: El envío desde WordPress es no-bloqueante (`blocking: false`). Esto significa que WordPress no esperará a que n8n procese el flujo para mostrar la página de éxito al usuario.
- **Respuesta Esperada**: n8n debe responder con un código HTTP `200` o `202` para confirmar la recepción.
- **Limitación de WordPress**: al usar `blocking: false`, WordPress solo puede detectar errores locales al iniciar la petición (`WP_Error`). No valida el código HTTP final devuelto por n8n.
- **Registro local**: si WordPress no puede iniciar la petición, se registra el error técnico con `error_log`.
- **Seguridad**: Por el momento no se requiere cabecera de autenticación. Si se implementa en el futuro, se utilizará la cabecera `Authorization: Bearer <TOKEN>`.

## 4. Seguridad y Buenas Prácticas (Recomendado)
Para asegurar la fiabilidad del sistema en producción, se sugieren las siguientes implementaciones:

- **Autenticación**: Se recomienda encarecidamente añadir una cabecera `X-API-KEY` o usar **HMAC Signature** para verificar que los leads provienen exclusivamente de este WordPress.
- **Retry Logic**: n8n debería estar configurado con "Retry on Fail" en los nodos críticos (como el envío de emails o escritura en CRM) para manejar errores temporales de red.
- **Global Error Trigger**: Se sugiere crear un flujo de error en n8n que notifique al equipo técnico si un lead no pudo ser procesado correctamente tras ser recibido.
- **Validación en Entrada**: n8n debe tratar el JSON como "no confiable" y validar la presencia de los campos mínimos (`name`, `phone` o `email`) antes de disparar el resto del flujo.

---
**Nota para el desarrollador**: Cualquier cambio en los nombres de las claves de la sección `data` debe ser coordinado para actualizar la entidad `LeadEntity` en el código PHP del tema.
