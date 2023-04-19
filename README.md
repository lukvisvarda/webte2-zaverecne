# Webte zaverecne zadanie

Treba zabezpečiť, aby priečinky vendor, node_modules atp. boli v gitignore.

## Docker run
docker compose up -d

## Backend run:
cd be
composer install (treba iba pri prvom spusteni)
php artisan serve

## Frontend run: 
cd fe
npm install (treba iba pri prvom spusteni)
npm run serve