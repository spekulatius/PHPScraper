# Instagram Scraper API

El equipo detrás de PHP Scraper está trabajando en proporcionar APIs comerciales para varios casos de uso común, así como plataformas. Estas APIs no son auto-alojadas. No tendrás que preocuparte de rotar IPs/proxies, ejecutando un navegador headless como Puppeteer. Una simple llamada a la API le permitirá obtener toda la información necesaria. Los servicios serán proporcionados en una atractiva estructura de tarifas dependiente del uso.

Para Instagram estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales propuestos

- Usuario: Detalles del perfil
- Usuario: Destacados
- Usuario: Mensajes
- Usuario: Mensajes etiquetados
- Usuario: Mensajes públicos
- Usuario: Seguidores
- Usuario: Obtener historias
- Usuario: Estado actual
- Usuario: Otras cuentas sociales
- Mensajes Públicos: Comentarios
- Publicación pública: Likers
- Descargador de historias con conversión a mp4, mp3, etc.
- Mensajes con Hashtags
- Mensajes de ubicación
- Búsqueda por ubicación
- Detalles del puesto
- Perfiles relacionados
- Buscar

::: tip CONSEJO
Tenga en cuenta que esta lista de puntos finales de la API no es *final* y es probable que cambie.
:::

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin peticiones ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
