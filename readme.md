#### Resumen de la API:
 Esta API proporciona un conjunto de endpoints para gestionar recursos de manera eficiente. Permite realizar operaciones CRUD (crear, leer, actualizar y eliminar) sobre los datos de los usuarios, asegurando autenticación y validación de las solicitudes. La API está diseñada para ser RESTful, facilitando la integración con diferentes aplicaciones y servicios. Incluye documentación para cada endpoint, ejemplos de uso y manejo de errores estandarizado.

## Listado de rutas y metodos
### Como registrarse
POST /register

Campos en formato JSON:
    {
        "name": "prueba"
        "email": "prueba@gmail.com"
        "role": "user"
        "password": "123456"
        "password_confirmation": "123456"
    }
### Como loguearse

POST /login

Campos en formato JSON:
    {
        "email": "prueba@gmail.com"
        "password": "123456"
    }
### Como cerrar sesion

POST /logout

Aqui en el postman debes en la parte del Auth tiene que poner el token que te da al logearte en el campo bearer token



### Ver usuarios(Admin)

 GET /users

 ### Ver usuarios en concreto(Admin)
 GET /users/{id}

 ### Editar usuario(Admin)
 PUT /users/{id}
 
 ### Eliminar usuario(Admin)

 DELETE /users/{id}

## Explicacion del JWT
O tambien llamado *JSON Web Token* son cruciales para la seguridad, pero abordan aspectos ligeramente diferentes de la seugirda JWT: la validacion garantiza que el token este bien formado y contenga afirmacion exigibles.
### Usuario Admin:
Esta es la cuenta del admin
email: kevin@gmail.com
password: 1234567



