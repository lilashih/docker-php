# docker-compose for php

## .env
Copy .env.example to .env.

- php.ini  
Choosing the xdebug settings in [php.ini](/php/php.ini) according to your ``PHP_DOCKERFILE``.

## Run
```shell
docker-compose build
docker-compose up -d
```

## Bash
```shell
docker-compose exec nginx bash
docker-compose exec mysql bash
docker-compose exec redis bash
docker-compose exec php /bin/sh
```

## Restart
```shell
docker-compose restart nginx
docker-compose restart mysql

// This will recreate any containers if ``.env`` have changes.
docker-compose up -d
```

## Laravel
```shell
docker-compose exec php /bin/sh
composer create-project --prefer-dist laravel/laravel blog
```

## Redis
```shell
docker-compose exec redis /bin/sh
redis-cli
```