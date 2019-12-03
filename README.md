# Price Checker
Application for parsing prices from web-sites. You can add products, stores and products' URLs in stores.
Product consists of 'Product name' and 'active' parameters (String and Boolean).
Store contains 'name', 'cookies', 'https', 'host' and CSS selectors for 'price', 'old price', 'sale' and 'city' parameters.

## Usage

### 1. Create config files:

```bash
cp console-dist.php console.php #email config
cp db-dist.php db.php #db config
```

### 2. Setup and run using host system

```bash
composer install #for install dependecies

php yii migrate #for create tables 
```

`web/` is public dir. `docker/nginx/default.template.conf` is nginx config. 


### 2. Or use Docker container

```bash
docker-compose up
```

1. Wait until `autoload.php` in `vendor` container's directory will be created.
1. Migrate: `docker exec -itw /var/www/html CONTAINER_ID bash`, `./yii migrate`, `yes`.
1. Go to `localhost:8000` or `DOCKER_MACHINE_IP:8000`

To find out DOCKER_MACHINE_IP use:
```bash
docker-machine ip
```

#### Add dependencies

Unix:
```bash
docker container run -it --volume $PWD:/app composer require PACKAGE_NAME
```

Windows:
```bash
docker container run -it --volume %PWD%:/app composer require PACKAGE_NAME
```

#### Call yii console app

```bash
docker exec CONTAINER_ID php yii
```

CONTAINER_ID could be find using the following command:
```bash
docker ps -aqf "name=php-fpm"
```

### 3. Run parsing

```bash
docker exec -itw /var/www/html CONTAINER_ID bash
./yii parse/parse
```
