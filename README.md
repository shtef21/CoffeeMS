# CoffeeMS

Php app


## Init docker

```sh
# Build image
docker build -t cms-img .

# Run container in background and expose port 5000 to host's 5000
docker run -dp 5000:5000 cms-img

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


## Upute

Instalacija XAMPPa na linuxu

```shell

# Download the installer from https://www.apachefriends.org/download.html

# If you haven't, install net-tools
sudo apt install net-tools

# Change permissions to the installer and run it
chmod 755 xampp-linux-*-installer.run
sudo ./xampp-linux-*-installer.run

# Start / stop XAMPP
sudo /opt/lampp/lampp start
sudo /opt/lampp/lampp stop

# Now open http://localhost
# This will use /var/www/html as server's root folder

# GUI tool
cd /opt/lampp
sudo ./manager-linux-run (or manager-linux-64.run)

```

## Design

#### Home page
<img src="git-images/home-page.png" alt="Home page" width="400"/>

#### Login
<img src="git-images/login-page.png" alt="git-images/login-page.png" width="400"/>

#### Register
<img src="git-images/register-page.png" alt="Register page" width="400"/>

#### About us
<img src="git-images/about-us-page.png" alt="About us" width="400"/>
