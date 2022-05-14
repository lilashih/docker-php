# Docker Compose For PHP
docker-compose for php

## .env
Copy .env.example to .env.

## Run
```shell
docker-compose build
docker-compose up -d
```

## Bash
```shell
docker-compose exec nginx bash

docker-compose exec redis /bin/sh

docker-compose exec mysql57 bash
docker-compose exec mysql80 bash

docker-compose exec php71 /bin/sh
docker-compose exec php74 /bin/sh
```

## Restart
```shell
docker-compose restart nginx
docker-compose restart mysql80
```

Or stop all services then up again. If you have changed the service's configurations in the services folder, stop all services first to avoid read the old settings.
```shell
docker-compose down
docker-compose up -d
```

## Laravel
```shell
docker-compose exec php74 /bin/sh
composer create-project --prefer-dist laravel/laravel blog
```

## Swoole
```shell
docker-compose exec php74 /bin/sh
php 7.4/swoole.php
```

## Mysql
```shell
mysql --host=localhost --port=6306 -uroot --default-character-set=utf8
```

## Redis
```shell
docker-compose exec redis /bin/sh
redis-cli --raw
```


## SSL
```shell
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout ssl.key -out ssl.csr
```

## phpmyadmin
- [config.inc.php](https://github.com/phpmyadmin/docker/blob/master/config.inc.php)