## How to run via docker

If running first time, follow these steps:

`cd src`

`cp .env.example .env`

Open .env file in src directory.
Change DB_USERNAME to anything else than root.
Put password. Save it.

`cd ../docker`

`docker-compose --env-file ../src/.env build app`

`docker-compose --env-file ../src/.env up -d`

Either ssh to ads-parser-app container or run it through docker-compose:

`docker-compose exec app rm -rf vendor composer.lock`

`docker-compose exec app composer install`


`docker-compose exec app php artisan key:generate`

`docker-compose exec app php artisan migrate`

`docker-compose exec app php artisan db:seed`

`docker-compose exec app php artisan schedule:work`

Here you go!
