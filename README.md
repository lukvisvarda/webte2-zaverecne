# Webte zaverecne zadanie

Treba zabezpečiť, aby priečinky vendor, node_modules atp. boli v gitignore.

## Docker run
docker compose up -d

## Backend run:
Pred spustenim je potrebne nastavit si subor .env v priecinku be. Ako template sluzi subor .env.example. Hodnoty,
ktore nie su potrebne som zakomentoval, toto je najdolezitejsia cast, teda setup db:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webte_zaverecne
DB_USERNAME=webte
DB_PASSWORD=pass123
```

Treba mat spusteny lokalne mysql server, ci uz prostrednictvom docker image alebo inak.
Vsetky nasledovne priazy spustat v podpriecinku be.
### Migracia databazy
```bash
$ php artisan migrate
```
### Seedovanie databazy
```bash
$ php artisan db:seed
```
#### Drop databazy
```bash
$ php artisan migrate:reset
```


### Spustenie servera po prvykrat
composer install je potrebny iba pri prvom spusteni
```bash
$ cd be
$ composer install 
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```
Api bezi na: _[http://localhost:8000](http://localhost:8000)_

## Frontend run: 
cd fe
npm install (treba iba pri prvom spusteni)
npm run serve