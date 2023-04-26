# Webte zaverecne zadanie

Treba zabezpečiť, aby priečinky vendor, node_modules atp. boli v gitignore.

## TODOS:
- [x] spravit sk*rvene corsy na backende, aby sa islo z fe nan pripojit
- [x] parser na latex subory s prikladmi

## Docker run
docker compose up -d

## App run:
Pred spustenim je potrebne nastavit si subor .env. Ako template sluzi subor .env.example. Hodnoty,
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
Vytvori studentske a ucielske konto `teacher@example.com` a `student@example.com` s heslom `pass123`

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
$ composer install 
$ npm install
$ php artisan migrate
$ php artisan db:seed
```
```bash
$ npm run dev
```
Apka bezi na: _[http://localhost:8000](http://localhost:8000)_