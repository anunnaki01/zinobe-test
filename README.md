# Zinobe Backend Test - PHP

Esta prueba fue realizada desde cero usando algunos paquetes de composer como

* illuminate/database (ORM eloquent para consultas y persistencia de los datos).
* bramus/router (Para el manejo de las rutas amigables).
* jenssegers/blade (Para el manejo de blade en las vistas).
* rakit/validation (Para la validacion de los campos),

Test
* phpunit/phpunit (Para las pruebas)
* mockery/mockery (Para hace los mocks de las clases en las pruebas)

## Requerimientos
Para instalar la aplicacion se necesita en la maquina tener instalado
* php >= 7.0 
* curl
* mysql >= 5.7
* xdebug (opcional solo para ejecutar el coverage)

## Instrucciones

* Clonar este repositorio en su maquina

* Se debe crear una base de datos en mysql e importar el fichero app-dump.sql para generar la tabla users:

* Para conectar la aplicacion a la base de datos creada se debe ingresar al fichero
config/database.php y modificar los datos de conección (host, database, username, password)
por los datos de su servicio de mysql.

* Ejecutar el comando **composer install** en la raiz del proyecto para descargar paquetes necesarios en la aplicación.

* Usar el siguiente comando para activar las rutas de la aplicación:

**sudo php -S localhost:80** 

Nota: En caso de que su puerto 80 este ocupado puede cambiarlo por el que desee y debe agregarlo al ingresar a la aplicación.

* Ingresar a la aplicación usando http://localhost 


## Pruebas

* Para correr las pruebas de la aplicación se debe estar ubicado en la raiz del proyecto y ejecurar el siguiente comand:

**vendor/bin/phpunit tests/**

* Para ver el coverage solo basta con entrar al directorio coverage/ y abrir en el navegador el fichero index.html

Nota: En caso de querer generar el coverage nuevamente ejecutar el comando 

**vendor/bin/phpunit tests --coverage-html=coverage**