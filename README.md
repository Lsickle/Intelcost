## About Intelcost

Aplicación sencilla para filtrar bienes y guardar aparte los bienes escogidos

## User Requirements

Aparte de los requerimientos solicitados incluye algunos adicionales como:

- [validacion de duplicados para no repetir los bienes guardados]().
- [peticiones realizadas de forma asincrona con Ajax]().
- [se mantiene actualizado el total de resultados para los filtros y la tabla de mis bienes]().
- [permite quitar elementos de la lista de mis bienes]().

## App Requirements
- [Laravel 7.3+](https://github.com/laravel/framework)

## Demo
- [Demo Application](c63c13aefc4a.ngrok.io) tunnel available for 8 hours.

## Installing Intelcost

 - clone this repository 
`git clone https://github.com/Lsickle/Intelcost.git`

 - install php dependencies 
`composer install`

 - install javascript dependencies and compilate scripts 
`npm install && npm run dev`

 - copy .env file 
`cp .env.example .env`

 - generate key file with artisan 
`php artisan key generate`

 - modify your .env file to especify your db_table, db_user and db_password 

 - run migrations 
`php artisan migrate`

 - Enjoy!

## Intelcost Sponsors

We would like to extend our thanks to the following sponsors for funding Intelcost development. 
  - [Yudy Bonilla](mailto:ybonilla@suplos.com)
  - [Marcela Acevedo](mailto:macevedo@suplos.com)

### Premium Partners

- **[Suplos](https://suplos.com/)**


