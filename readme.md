## docker-compose for php

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
docker-compose exec mysql bash
docker-compose exec php /bin/sh
```

## Restart
```shell
docker-compose restart nginx
docker-compose restart mysql
```

## Laravel
```shell
docker-compose exec php /bin/sh
composer create-project --prefer-dist laravel/laravel blog
```