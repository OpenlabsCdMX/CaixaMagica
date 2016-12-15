# CaixaMagica
----------

#### Proyecto Caja Mágica ####

Caja mágica surge como un proyecto comunitario dentro del LABICBR que busca crear espacios de escucha comunitaria para que todas las voces puedan ser escuchadas.

Laca caja está conformada por 3 aspectos, el software e infraestructura, la instalación física y la metodología. En este repositorio podrá encontrar todo lo relacionado con el software e infraestructura.

[Sitio Web](http://caixamagi.ca/) — [Contacto](mailto:info@caixamagi.ca/)


### Comunidad ###

La caja fue desarrollada con tecnologas libres y licencias que la soportan, está abierta todo aquel que quiera colaborar en su desarrollo y por esto su documentación y bases se enceuntra en este repositorio; tambén la imagen de la Raspberri Pi configurada para funcionar como servidor.

### Los componentes de la caja y la tecnología de la misma ###

La caja se constituye en su parte de infraestructura y desarrollo (hardware y software sin instalaciones) de:

A nivel de hardware:

- 1 Router con capacidad de Wifi
- 1 Raspberri Pi 2 con memoria SD 8GB
- 1 Powerbank con doble alimentación (para el Router y la Raspi)

A nivel de Software:

### Frontend: ###
- HTML5
- CSS3
- JQuery 3.1.1
- Bootstrap 3.3.7
- Modernizr

### Backend: ###
- PHP 5.6
- Apache Server 2.2
- MariaDB / MySQL
- Raspbian

### ¿Cómo funciona la caja? ###

La caja puede ser configurada desde un panel de administración con multiples opciones que permiten:

1. Creación de nuevas cajas: las cajas son un conjunto de asuntos a discutir para conocer la opinión de todos.
2. Creación de asuntos para las cajas: los asuntos son temas puntuales que se discutirán dentro de una caja y cada asunto puede tener opciones de respuestas asociadas al mismo.
3. Creación de opciones: las opciones pueden ser de distintos tipos, actualmente se soportan plenamente las opciones multiples y las opciones de preguntas abiertas; a futuro se dará soporte a las preguntas de tipo pila.

Para mayor información al respecto remitete al [Sitio Web](http://caixamagi.ca/)

Una ves creada una caja esta se publica y es accesible al público al conectarse a la red inalambrica abierta del router mediante un portal cautivo.
