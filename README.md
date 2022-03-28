# CRUD de estudiantes donde se podrá crear roles, permisos y usuarios en Laravel 8.* 

Sistema web para crear, modificar, eliminar y listar usuarios, roles y permisos.

# Comenzando

Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

# Pre-requisitos

_Que herramientas/programas necesitas para poner en marcha el proyecto y como instalarlos_

* GIT [Link](https://git-scm.com/downloads)
* Entorno de servidor local, Ej:[XAMPP](https://www.apachefriends.org/es/index.html) o [LAMPP](https://bitnami.com/stack/lamp/installer).
* PHP Version 7.4 - 8.0 [Link](https://www.php.net/downloads.php).
* Manejador de dependencias de PHP [Composer](https://getcomposer.org/download/).

# Instalación

Paso a paso de lo que debes ejecutar para tener el proyecto en su servidor local.

 1. Primero que nada, clic en Fork

 2. Desde la consola, inicia el git dentro de tu servidor:
    ```
    git init
    ```
 3. Luego, clona el repositorio dentro de la carpeta de tu servidor con el siguiente comando:
    ```
    git clone https://github.com/danielduran90/school.git
    ```
 4. Ingresa a la carpeta del repositorio recien descargado desde tu explorador de archivos o con el siguiente comando:
    ```
    cd school
    ```
 5. Instala las dependencias del proyecto con los siguientes comandos:
    ```
    composer install
    ```
 5. En la carpeta raiz del proyecto, modifica el archivo ".env" los valores por los del acceso a su Base de datos.[ejemplo](https://github.com/danielduran90/school/blob/main/.env).

 6. Ejecuta las migraciones y agrega los primeros registros con el siguiente comando:
    ```
    php artisan migrate --seed
    ```
 7. Inicializa el servidor local con el siguiente comando:
    ```
    php artisan serve
    ```
 8. Listo, ya podrás visualizar e interactuar con el proyecto en local.

 usuarios para pruebas:

 - user: admin@gmail.com
 - Password: 12345
 - Role: Admin

 - user: carlos@gmail.com
 - Password: 12345
 - Role: Docente

 - user: daniel@gmail.com
 - Password: 12345
 - Role: Estudiante
