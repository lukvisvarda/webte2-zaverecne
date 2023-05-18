# Webte zaverecne zadanie

![Vue3](https://img.shields.io/badge/Vue-3-green)
![Laravel10.8](https://img.shields.io/badge/Laravel-10.8-red)

## Frontend

Vue sa nachadza v priečinku `frontend`.

## Docker run
Treba nastavit .env subor podla .env.docker

```bash
docker compose up -d
```

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
Pristupove udaje do db sa nastavuju v .env subore.

### Migracia databazy

```bash
$ npm run db:migrate
```

### Seedovanie databazy

Vytvori studentske a ucielske konto `teacher@example.com` a `student@example.com` s heslom `pass123`

```bash
$ npm run db:seed
```

#### Drop databazy

```bash
$ npm run db:drop
```

### Spustenie servera po prvykrat

composer install a npm install je potrebny iba pri prvom spusteni

```bash
$ composer install
```

```bash
$ npm install
```

Tento prikaz namigramuje databazu a seedne ju.

```bash
$ npm run setup
```

```bash
$ npm run dev
```

Apka bezi na: _[http://localhost:8000](http://localhost:8000)_
