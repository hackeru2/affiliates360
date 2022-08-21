# Affiliates 360
## Home Assignment


[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

    A simple migration , seeder and api app.


## Requirements

- docker
- docker-compose

OR  :

php 8
npm
composer2



## Installation

create env file from example .

```sh
cp .env.example .env
```

Start the server, db and phpmyadmin.

```sh
./vendor/bin/sail up
```
The server should run on http://localhost

laravel -mix :

```sh
npm run watch
```

## Migrations and Seeder
This action will create the database be-profit with the data from the external api .
```sh
./vendor/bin/sail php artisan migrate:fresh --seed 
```

## Api
| Method           | Path                              |
|------------------|-----------------------------------|
| Todos            | http://localhost/api/todos        |
| Projects         | http://localhost/api/projects     |
| Users            | http://localhost/api/users        |
 

## PhpMyAdmin

```sh
http://localhost:8085
```
 
## License

MIT
 