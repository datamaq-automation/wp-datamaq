# TODO del Proyecto - Datamaq Costs

## Base
- [x] Inicializar la estructura del plugin (cumpliendo DDD).
- [x] Crear la página de Ajustes en el Administrador de WordPress.
    - [x] Campo: Google Maps API Key.
    - [x] Campo: Dirección de Origen.
    - [x] Campo: Valor por KM.
    - [x] Campo: Valor Hora Ingeniería.
    - [x] Campo: Valor Hora Montaje.
    - [x] Campo: Tarifa Base para Relevamiento.

## Integración
- [x] Implementar el cliente para la API de Google Distance Matrix.
- [ ] Implementar el mecanismo de respaldo manual para el ingreso de KM.

## Funcionalidades
### Relevamiento Técnico
- [ ] Crear el frontend del formulario de "Solicitud de Presupuesto".
- [ ] Implementar la lógica del lado del servidor para el cálculo de KM.
- [ ] Implementar la fórmula de costo: `Base + (KM * Valor)`.

### Automatización a Medida
- [ ] Crear la interfaz de entrada para las horas de Ingeniería/Montaje.
- [ ] Implementar la fórmula de costo: `(HorasIng * ValorIng) + (HorasMont * ValorMont)`.

## Pruebas y Pulido
- [ ] Probar escenarios de falla de la API.
- [ ] Mejoras de UI/UX para el formulario de presupuesto.
