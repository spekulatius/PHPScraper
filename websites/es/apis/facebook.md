# Facebook Scraper API

El equipo detrás de PHP Scraper está trabajando en proveer APIs comerciales para varios casos de uso común así como plataformas. Estas APIs no son auto-alojadas. No tendrás que preocuparte por rotar IPs/proxies, ejecutando un navegador sin cabeza como Puppeteer. Una simple llamada a la API le permitirá obtener toda la información necesaria. Los servicios serán proporcionados en una atractiva estructura de tarifas dependiente del uso.

Para Facebook estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales propuestos

- Usuario: Perfil de usuario público
- Usuario: Otras cuentas sociales
- Usuario: Lista de amigos
- Usuario: Imágenes
- Usuario: Mensajes de ubicación
- Usuario: Mensajes de usuario
- Público Grupos y grupos privados con clave: Perfil del grupo público
- Público Grupos y grupos privados con clave: Lista de miembros
- Público Grupos y grupos privados con clave: Imágenes
- Público Grupos y grupos privados con clave: Perfil del grupo público Mensajes de ubicación
- Público Grupos y grupos privados con clave: Mensajes Mensajes
- Mensajes: Detalles del post público (incluyendo comentarios, likes, likers, etc.)

::: tip CONSEJO
Tenga en cuenta que esta lista de puntos finales de la API no es *final* y es probable que cambie.
:::

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin peticiones ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
