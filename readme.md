## docker-compose for php

## .env
1. 將.env.example複製成.env
2. 有時更新.env時需要重載image

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
```