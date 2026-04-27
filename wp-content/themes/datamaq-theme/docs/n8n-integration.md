# Especificación Técnica: Integración WordPress -> n8n

Este documento define el contrato de integración para el sistema de captura de Leads del tema DataMaq.

## 1. Endpoint del Webhook
- **URL por defecto**: `https://n8n.datamaq.com.ar/webhook/contact-form`
- **Configuración en WordPress**: la URL puede cambiarse desde `Ajustes -> n8n Integration` mediante la opción `dm_n8n_webhook_url`.
- **Método HTTP**: `POST`
- **Content-Type**: `application/json`
- **Autenticación actual**: opcional mediante `X-API-KEY`.
- **Secreto de autenticación**: debe definirse fuera del repositorio, por ejemplo en `wp-config.php` con la constante `DATAMAQ_N8N_API_KEY`.
- **Configuración de n8n**: el workflow, credenciales y variables de entorno de n8n no forman parte de este tema y no deben versionarse en este repositorio.

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
- **Seguridad**: si `DATAMAQ_N8N_API_KEY` está definida y no está vacía, WordPress envía la cabecera `X-API-KEY` con ese valor. Si no está definida, no se envía ninguna cabecera de autenticación.

## 4. Seguridad y Buenas Prácticas (Recomendado)
Para asegurar la fiabilidad del sistema en producción, se sugieren las siguientes implementaciones:

- **Autenticación en n8n**: si se activa `X-API-KEY` del lado WordPress, n8n debe validar esa cabecera contra un secreto guardado en su propia configuración o variables de entorno.
- **Retry Logic**: n8n debería estar configurado con "Retry on Fail" en los nodos críticos (como el envío de emails o escritura en CRM) para manejar errores temporales de red.
- **Global Error Trigger**: Se sugiere crear un flujo de error en n8n que notifique al equipo técnico si un lead no pudo ser procesado correctamente tras ser recibido.
- **Validación en Entrada**: n8n debe tratar el JSON como "no confiable" y validar la presencia de los campos mínimos (`name`, `phone` o `email`) antes de disparar el resto del flujo.

---
**Nota para el desarrollador**: Cualquier cambio en los nombres de las claves de la sección `data` debe ser coordinado para actualizar la entidad `LeadEntity` en el código PHP del tema.
