# Webte zaverecne zadanie

![Vue3](https://img.shields.io/badge/Vue-3-green)
![Laravel10.8](https://img.shields.io/badge/Laravel-10.8-red)

Treba zabezpečiť, aby priečinky vendor, node_modules atp. boli v gitignore.

## Frontend

Vue sa nachadza v priečinku `frontend`.

# Davam do povedomia:

- Nie je implementované pridávanie zadaní podľa času.

## TODOS:
- latex input nefunguje, ked nie je focusnuty(lukas simon)
- obrazok sa nezobrazuje pri rieseni ulohy (Janci)
- investigate: ake su moznosti kontrolovania tych ekvivalentnych spravnych rieseni (skusal som robehat tie srandy co tam oni navrhovali, ale vyzera to ako pain, mozno by bolo lepsie pouzit nejaky pythonovsky validator a ten potom rozbehat na serveri, ale nie som si isty.) - patres
- investigate: ako dostat tuto haluz na server
- vyber z pridelenych suborov, z ktorych chce student generovat priklady
- be + fe - pod tagy pridat pre kazdy tag (priradenu ulohu) aj cas odomknutia pre danu ulohu v componente `AssignThesis`
- docker composer nefunguje(to spravi IBAN)
- [x] v sekcii studenta dorobit component, ktory zobrazi vsetky pridelene ulohy, tak aby ten isty component vedel zobrazit aj uz vyriesene priklady(teoreticky by na to mohol stacit aj komponent `TeacherTable`)
- [x] be + fe - okrem generovania potrebujeme aj pre studenta sekciu pre prehlad, kde bude vidno ktore priklady su pre neho vygenerovane, treba k tomu aj spravit `endpoint`
- [x] be - roleguard na backende(aby student nevedel zavolat endpointy pre ucitela, na ten sa mozno mozeme vygabat, to nebudu kontrolovat)
- [x] fe - pohrat sa s responzivitou (ucitel done)
- [x] fe - z navbaru dat prec buttony podla danej roly ktora je prihlasena (teacher -> ucitel), (student -> student)
- [x] investigate: po zmenseni okna sa do\*ebe navbar, vyriesit
- [x] be + fe - pridat moznost ucitela skontrolovat pracu studentov, kto ma kolko bodov, ktore ulohy riesil apod
- [x] be - authguard na backende(aby non logged user nevedel robit requesty)
- [x] funkcionalita ucitela na vyberanie prikladov (backend + frontend)
- [x] fe - fixnut endpoint `/api/user/generate` tak aby returnol chybnu message v pripade ze ziadne priklady nie su zvolene pre riesenie (prikldy voli ucitel v sekcii insert).
- [x] zmenit `LatexFile` model tak, aby mu ucitel vedel nastavit maximalny pocet bodov, ktory sa potom bude pri generacii prikladov z daneho suboru pridelovat
- [x] many to many relationship medzi user a problem treba prerobit na dalsiu entitu a pridat do nej aj stlpce `solved`, `pocet_bodov`, a `maximalny_pocet_bodov`, aby bolo mozne trackovat, ktory student ktore priklady vyriesil a kolko zane dostal bodov
- [x] register (vytvorenie endpointu + frontend formular)
- [x] investigate: tagy v komponente `AssignThesis` nefunguju vobec
- [x] spravit sk\*rvene corsy na backende, aby sa islo z fe nan pripojit
- [x] parser na latex subory s prikladmi
- [x] login (frontend + backend)
- [x] auth guard, role guard na frontende

## Docker run

nerobit, je to do\*ebe, treba to prerobit

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
