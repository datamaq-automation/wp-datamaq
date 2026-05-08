# DISCOVERY - Dudas y Definiciones Pendientes

Este documento registra exclusivamente las incertidumbres técnicas que requieren definición antes de proceder.

## 🤖 Integración de BotMan (PHP)
- **Dependencias:** ¿Se deben instalar `botman/botman` y `botman/driver-web` inmediatamente vía Composer?
- **Endpoint del Webhook:** ¿Se debe registrar en la REST API (`/wp-json/datamaq/v1/botman`) o mediante un handler de Admin AJAX?
- **Interfaz (Frontend):** ¿Existe una librería de JS preferida para el widget del chat o se debe implementar una solución custom?
- **Persistencia:** ¿Se utilizará la API de Transients de WordPress o se requiere un driver de persistencia externo (Redis/Memcached)?

## 🚀 Continuous Delivery (CD)
- **Destino del Despliegue:** ¿Cuál es la infraestructura de destino (VPS via SSH/rsync, Hosting compartido via FTP, o plataforma Cloud)?
- **Secretos de GitHub:** ¿Están ya configuradas las credenciales en el repositorio para el despliegue automático?

## 📊 Auditoría de Repositorio
- **Exclusión de Core:** ¿Se ha confirmado la migración definitiva a un modelo donde el Core de WordPress no sea trackeado por Git?
