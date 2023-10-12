# CoffeeMS
Php app

## Init docker

```sh
# Build image
docker build -t cms-img .

# Run container
docker run cms-img

# OR run and forward port 3000 to localhost:3000
docker run -p 127.0.0.1:3000:3000 cms-img

# OR start it as a background process
docker run -dp 127.0.0.1:3000:3000 cms-img

# List docker containers
docker ps
```


## Zadaci


### Zadatak 1 - Init, routing

Naslovna stranica i routing na ostale (ostale ne moraju nužno biti napravljene)

https://lms-2020.tvz.hr/mod/resource/view.php?id=5957


### Zadatak 2 - Baza podataka

Izrada baze podataka na temelju definicije podataka.


### Zadatak 3 - Prijava i registracija

? Omogućiti automatsko generiranje usernamea i passworda?
+ Kriptiranje lozinke


### Zadatak 4 - CMS sustav

CRUD korisnika - ADMIN
CRUD pića - ADMIN, EDITOR
API pretraživanje koktela - ADMIN, EDITOR

