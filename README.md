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
