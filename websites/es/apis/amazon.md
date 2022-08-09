# Amazon Scraper API

El equipo detrás de PHP Scraper está trabajando en la provisión de APIs comerciales para varios casos de uso común así como para plataformas. Estas APIs no están pensadas para ser auto-alojadas y se proporcionarán en base a un pago por uso.

Para Amazon estamos considerando la implementación de una API con el siguiente alcance.

## Puntos finales propuestos

- Obtener información del producto
- Obtener recomendaciones
- Obtener información de la revisión
- Obtener información del vendedor
- Obtener todos los precios de los vendedores
- Buscar productos por palabra clave o ID de vendedor

Tenga en cuenta que esta información no es definitiva y es probable que cambie.

## Soporte de la plataforma

Con el enfoque de utilizar una API gestionada, los usuarios se liberan de preocuparse por la rotación de proxies, los problemas de escalado y las interrupciones. Además, se admite una amplia gama de plataformas. Se puede integrar fácilmente en NodeJS, Python (sin requests ni beautifulsoap), Golang, etc. Cualquier plataforma que permita ejecutar peticiones GET puede ser programada para solicitar datos de este servicio.
