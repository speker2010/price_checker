# Price checker
It's application for parsing prices from sites. You can add product, stores and add url product in store.
Product is simple. 'Product name' and 'active' it or not.
Store contain 'name', 'cookies', 'https', 'host' and css selectors for 'price', 'old price', 'sale' and 'city'.

You have 2 options:

'Setup and run' and 'docker run'.

First option: install environment manualy.

Second: docker environment.

## Create config files:
```bash
cp console-dist.php console.php 
cp db-dist.php db.php #db config
```

## setup and run
```bash
composer install #for install dependecies

php yii migrate #for create tables 
```

`web/` is public dir. `docker/nginx/default.template.conf` is nginx config. 


## docker run
```bash
docker-compose up
```
1. Wait while creating autoload.php in ```vendor``` dir in composer container.
1. Migrate up `docker exec -itw /var/www/html CONTAINER_ID bash`, then `./yii migrate`. Type `yes`
1. Go to localhost:8000 or DOCKER_MACHINE_IP:8000

Where DOCKER_MACHINE_IP from results for:
```
docker-machine ip
```

## Add dependencies
```
$ docker container run -it --volume $PWD:/app composer require PACKAGE_NAME
```
or for windows
```
$ docker container run -it --volume %PWD%:/app composer require PACKAGE_NAME
```

## Call yii console app
```
$ docker exec CONTAINER_ID php yii
```
CONTAINER_ID you can find for container with php-fpm:
```
docker container ls
```
## run parsing
```
$ docker exec -itw /var/www/html CONTAINER_ID bash
$ ./yii parse/parse
```
