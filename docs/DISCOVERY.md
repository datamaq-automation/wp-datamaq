# DISCOVERY - Dudas y Definiciones Pendientes

Este documento registra exclusivamente las incertidumbres técnicas que requieren definición antes de proceder.

## 🤖 Integración de BotMan (PHP) - PRÓXIMAMENTE
- **Dependencias:** Confirmado el uso de `botman/botman` y `botman/driver-web`.
- **Endpoint del Webhook:** Se propone usar la REST API de WordPress (`/wp-json/datamaq/v1/chat`) para mayor escalabilidad y facilidad de debug.
- **Interfaz (Frontend):** Se implementará un widget custom reactivo integrado en el tema para mantener la coherencia estética (Design Tokens).
- **Persistencia:** Se utilizará la API de Transients de WordPress inicialmente, evaluando migrar a una tabla custom si el volumen de sesiones lo requiere.

## ✅ Infraestructura y CD (RESUELTO)
- **Modelo:** CD en 8 etapas con validación inteligente (Local CI + Remote CD).
- **Destino:** VPS vía SSH/Rsync (Puerto 5932).
- **Entorno:** Configurado en GitHub Actions bajo el environment `prod`.
- **Estrategia Slim Repo:** El núcleo de WordPress y archivos de configuración sensibles (`wp-config.php`, `.env`) están excluidos y se gestionan directamente en el servidor.

---

## 📊 Auditoría de Repositorio (RESUELTO)
- Se ha limpiado el repositorio de archivos temporales y logs.
- La arquitectura hexagonal está validada y lista para recibir el dominio de BotMan.
