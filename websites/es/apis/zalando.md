# Zalando Scraper API

El equipo detrás de PHP Scraper está trabajando en proporcionar APIs comerciales para varios casos de uso común, así como plataformas. Estas APIs no están pensadas para ser auto-alojadas y se proporcionarán en base a un pago por uso.

Para Zalando estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales propuestos

- Obtener detalles del producto
- Búsqueda de productos por palabra clave

Tenga en cuenta que esto no es definitivo y es probable que cambie.

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin peticiones ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
