# Especificación Técnica: Integración WordPress -> n8n

Este documento define el contrato de integración para el sistema de captura de Leads del tema DataMaq.

## 1. Endpoint del Webhook
- **URL Temporal**: `https://n8n.datamaq.com.ar/webhook/contact-form`
- **Método HTTP**: `POST`
- **Content-Type**: `application/json`

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

## 3. Comportamiento y Errores
- **Asincronía**: El envío desde WordPress es no-bloqueante (`blocking: false`). Esto significa que WordPress no esperará a que n8n procese el flujo para mostrar la página de éxito al usuario.
- **Respuesta Esperada**: n8n debe responder con un código HTTP `200` o `202` para confirmar la recepción.
- **Seguridad**: Por el momento no se requiere cabecera de autenticación. Si se implementa en el futuro, se utilizará la cabecera `Authorization: Bearer <TOKEN>`.

## 4. Seguridad y Buenas Prácticas (Recomendado)
Para asegurar la fiabilidad del sistema en producción, se sugieren las siguientes implementaciones:

- **Autenticación**: Se recomienda encarecidamente añadir una cabecera `X-API-KEY` o usar **HMAC Signature** para verificar que los leads provienen exclusivamente de este WordPress.
- **Retry Logic**: n8n debería estar configurado con "Retry on Fail" en los nodos críticos (como el envío de emails o escritura en CRM) para manejar errores temporales de red.
- **Global Error Trigger**: Se sugiere crear un flujo de error en n8n que notifique al equipo técnico si un lead no pudo ser procesado correctamente tras ser recibido.
- **Validación en Entrada**: n8n debe tratar el JSON como "no confiable" y validar la presencia de los campos mínimos (`name`, `phone` o `email`) antes de disparar el resto del flujo.

---
**Nota para el desarrollador**: Cualquier cambio en los nombres de las claves de la sección `data` debe ser coordinado para actualizar la entidad `LeadEntity` en el código PHP del tema.
