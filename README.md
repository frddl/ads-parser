## How to run via docker

If running first time, follow these steps:

cp .env.example .env

Open .env file.
Change DB_USERNAME to anything else than root.
Put password. Save it.

docker-compose --env-file ../src/.env build app

docker-compose --env-file ../src/.env up -d

Either ssh to ads-parser-app container or run it through docker-compose:

docker-compose exec app rm -rf vendor composer.lock
docker-compose exec app composer install

docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

Here you go!