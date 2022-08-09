# Facebook Scraper API

El equipo detrás de PHP Scraper está trabajando en la provisión de APIs comerciales para varios casos de uso común así como para plataformas. Estas APIs no están pensadas para ser auto-alojadas y se proporcionarán en base a un pago por uso.

Para Facebook estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales propuestos

- Usuario: Perfil de usuario público
- Usuario: Otras cuentas sociales
- Usuario: Lista de amigos
- Usuario: Imágenes
- Usuario: Mensajes de ubicación
- Usuario: Mensajes de usuario
- Grupos públicos y grupos privados con clave: Perfil del grupo público
- Grupos públicos y grupos privados con clave: Lista de miembros
- public Grupos y grupos privados con clave: Imágenes
- público Grupos y grupos privados con clave: Perfil del grupo público Mensajes de ubicación
- público Grupos y grupos privados con clave: Mensajes Mensajes
- Mensajes: Detalles del post público (incluyendo comentarios, likes, likers, etc.)

Tenga en cuenta que esto no es definitivo y es probable que cambie.

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin peticiones ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
