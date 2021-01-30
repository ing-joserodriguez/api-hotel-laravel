<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Acerca de API Hotel

Es una API desarrollada en Laravel 8 y MySQL. En su primera version permite:

- Visualizar todas las habitaciones del hotel, con sus respectivas reservaciones y clientes asociadas.
- Modificar la informacion basica de las habitaciones (nombre, tipo y estado).
- Gestion de usuarios para la autenticacion mediante token (oAuth2).
- Asignacion de permiso para poder modificar la informacion de las habitaciones y de otros usuarios.

## Como usar API Hotel

- Descargar o clonar este proyecto en su equipo local.
- Ejecutar los migrates y seeders del proyecto. Para cargar los datos de prueba.
- Para ejecutar las migrate <code><strong>php artisan migrate</strong></code>
- Para ejecutar las seeders <code><strong>php artisan db:seed</strong></code>
- Abrir el software o extension de su preferencia probar la API
- Iniciar sesion con el usuario por defecto <code><strong>admin@example.com</strong></code> y la contrasena <code><strong>password</strong></code> para obtener el token de autentificacion.
- Tomar la ruta corresponidente a la funcion que desea probar y agregue los parametros requeridos segun sea el caso.
- Recuerde de incluir el token <code><strong>Authorization: Bearer 'token_generado'</strong></code> en la seccion de HEADERS del probador de APIs.

## Para probar la API con Postman (Recomendado)(Opcional)

- Descargar Postman, que es una plataforma para el desarrollo y prueba de APIs.
- Descargar postman aca [https://www.postman.com/downloads/](https://www.postman.com/downloads/)
- Instalar postman, abrirlo e importar el archivo de coleccion <code><strong>API Hotel.postman_collection.json</strong></code>  que esta en la raiz de este proyecto.

Una vez realizado los pasos anteriores, ya se podra probar la api dentro del entorno de postman.