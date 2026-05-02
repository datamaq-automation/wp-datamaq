# Guía para Obtener la Google Maps API Key

Para que el plugin pueda calcular las distancias automáticamente, necesitas configurar una API Key de Google Cloud con los permisos adecuados.

## Paso 1: Crear un Proyecto en Google Cloud
1. Ve a [Google Cloud Console](https://console.cloud.google.com/).
2. Haz clic en el desplegable de proyectos (arriba a la izquierda) y selecciona **"Nuevo proyecto"**.
3. Ponle un nombre (ej: `Datamaq Automation`) y créalo.

## Paso 2: Habilitar la API Necesaria
1. En el menú lateral, ve a **"APIs y servicios"** > **"Biblioteca"**.
2. Busca **"Distance Matrix API"**.
3. Haz clic en ella y luego en el botón **"Habilitar"**.
   * *Nota: También se recomienda habilitar la "Places API" si planeas usar autocompletado de direcciones en el futuro.*

## Paso 3: Crear las Credenciales (La Key)
1. Ve a **"APIs y servicios"** > **"Credenciales"**.
2. Haz clic en **"+ Crear credenciales"** > **"Clave de API"**.
3. Se generará una clave (una cadena de texto larga). **Cópiala**, la necesitaremos para el plugin.

## Paso 4: Restringir la Key (Recomendado por Seguridad)
Es vital restringir la clave para que nadie más pueda usar tu cuota.
1. En la misma pantalla de "Credenciales", edita la clave que acabas de crear.
2. Bajo **"Restricciones de aplicación"**, selecciona **"Sitios web"**.
3. Agrega la URL de tu sitio (ej: `https://datamaq.com.ar/*`).
4. Bajo **"Restricciones de API"**, selecciona **"Restringir clave"** y elige únicamente **"Distance Matrix API"**.
5. Guarda los cambios.

## Paso 5: Configurar la Facturación
Google requiere que el proyecto tenga una cuenta de facturación vinculada (aunque suelen dar una cuota gratuita mensual generosa de $200 USD).
1. Ve a la sección **"Facturación"** en el menú lateral.
2. Vincula una tarjeta o cuenta si aún no lo has hecho.

---

### ¿Dónde pegar la clave?
Una vez que tengas la clave, ve al panel de WordPress de Datamaq:
**Datamaq Costs > Google Maps API Key** y pega el código allí.
