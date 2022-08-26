# TikTok Scraper API

El equipo detrás de PHP Scraper está trabajando en la provisión de APIs comerciales para varios casos de uso común así como para plataformas. Estas APIs no son auto-alojadas. No tendrá que preocuparse de rotar IPs/proxies, ejecutando un navegador sin cabeza como Puppeteer. Una simple llamada a la API le permitirá obtener toda la información necesaria. Los servicios serán proporcionados en una atractiva estructura de tarifas dependiente del uso.

Para TikTok estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales soportados propuestos

- Búsqueda por etiqueta
- Usuario: Detalles del perfil público
- Usuario: Otras cuentas sociales
- Detalles del vídeo
- Descarga de vídeo con conversión a mp4, mp3, etc. y sin marca de agua

::: tip CONSEJO
Tenga en cuenta que esta lista de puntos finales de la API no es *final* y es probable que cambie.
:::

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin peticiones ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
