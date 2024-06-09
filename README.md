<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Club Deportivo API

## Sobre este proyecto

Se trata de una API REST desarollarada en Laravel que permite la administración de un club deportivo.

Dicho club dispone de numerosas pistas de diferentes deportes, que son los siguientes:

- Tenis
- Paddle
- Futbol
- Baloncesto
- Voleibol

Para poder reservar y acceder a las instalaciones, deberças solicitar a algún administrador para que te dé de el alta
como **Socio**. Dichos administradores son los **Usuarios** que manejan la aplicación. 

Cada **Deporte** tiene asociado una o varias **Pistas** donde se puede practicar el deporte. Y para ello es necesario
realizar una **Reserva** en una fecha y hora concreta. Dichas reservas son de Lunes a Domingo de 8:00 a 22:00,
cerrando las instalaciones a las 22:00.

Además de todo esto, se dispone de:
- Un *buscador de pistas*, que permite visualizar las pistas disponibles para la reserva de un socio.
- Un listado de *reservas para un día concreto*, que permite visualizar las reservas de todo un día.

## Instalación

Para la ejecución de este projecto se debe tener instalada la última versión de PHP, Composer y algúna base de 
datos como MySQL o PostgreSQL. Se puede utilizar Xamp, Docker o, si dispones de Windows o MacOS, [Laravel Herd](https://herd.laravel.com/)
que nos instala los componentes necesarios para crear un entorno de ejecución perfecto.

Una vez descargado el proyecto, con el comando `composer install` se instalarán todas las dependencias. Lo siguiente
es configurar el archivo de variables de entorno junto con la base de datos. Para ello, modificamos el nombre del archivo
`.env.example` por `.env`.

Después debemos modificar los datos de conexión a nuestra base de datos.

- `DB_CONNECTION=pgsql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=5432`
- `DB_DATABASE=club-deportivo`
- `DB_USERNAME=YOUR_USER`
- `DB_PASSWORD=YOUR_PASSWORD`

Estos podrían ser unso datos de prueba para una conexión con PostreSQL.

Se debe generar la key de la APP, llamada `APP_KEY`, y para ello ejecutamos el comando `php artisan key:generate`.
Automáticamente se generará la key y se incluirá en fichero.

Lo último a modificar en el fichero será añadir tres claves al final, que se utilizarán para la autenticación OAuth2.
Las claves son:

- `SECRET="YOUR_SECRET_KEY"`
- `PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY----- YOUR_PRIVATE_KEY -----END RSA PRIVATE KEY-----"`
- `PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY----- YOUR_PUBLIC_KEY -----END PUBLIC KEY-----"`

`SECRET`puede ser cualquier palabra, será el nombre que tendrá el token de acceso generado en la base de datos.

Las claves publica y privada necesarias estarán en la carpeta `/storage` bajo el nombre `oauth-public.key` y
`oauth-private.key` respectivamente. Deberemos copiar el contenido de la clave en la correspondiente variable del 
fichero `.env`.

> **Importante:** La base de datos debe existir para el siguiente comando, en este caso llamada *club-deportivo*.

Con todo configurado, podemos ejecutar el comando `php artisan migrate` que lanzará las migraciones contra la base de datos.

Ahora ya podemos ejecutar los scripts `dml.sql` y `dll.sql` ubicados en la carpeta `/scripts` contra la base de datos
para poblarla.

Ya podemos arrancar nuestro proyecto utilizando el comando `php artisan serve`, que nos facilitará la URL a la que acceder.

## Documentación

Para poder poder visualizar todos los endpoints disponibles y probarlos, se puede acceder a la documentación de Swagger
desde la URL base en: [/api/v1/documentation](http://127.0.0.1:8000/api/v1/documentation)

Una vez dentro, los únicos endpoints accesibles sin autorización son:
- POST `/users`: Permite registrarse en el sistema como Usuario.
- GET `/auth/login`: Permite loguearse para obtener el token de acceso.

Si disponemnos del token de acceso, podemos iniciar sesión pulsando el botón ***Authorize*** para introducir el token.
De esta forma ya tenemos acceso a todas las rutas.
