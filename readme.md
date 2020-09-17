## docker-compose for php

## .env
1. Copy .env.example to .env.
2. Sometimes you need to reload image after updated .env.

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