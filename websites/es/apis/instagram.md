# API de Instagram Scraper

El equipo detrás de PHP Scraper está trabajando en proporcionar APIs comerciales para varios casos de uso común, así como plataformas. Estas APIs no están pensadas para ser auto-alojadas y se proporcionarán en base a un pago por uso.

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

Tenga en cuenta que esto no es definitivo y es probable que cambie.

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin requests ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
