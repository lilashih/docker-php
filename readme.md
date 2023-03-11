# Docker Compose
Building the development environment quickly.

## .env
Copy the .env.example file to .env.

## Run
### First installation
```shell
docker-compose build
docker-compose up -d
```

### Start the services
```shell
docker-compose up -d
```

### Stop the services
```shell
docker-compose down
```

## Enter the containers
```shell
docker-compose exec nginx bash

docker-compose exec php71 /bin/sh
docker-compose exec php74 /bin/sh
docker-compose exec php80 /bin/sh
docker-compose exec php81 /bin/sh
docker-compose exec php82 /bin/sh

docker-compose exec redis /bin/sh

docker-compose exec mysql57 bash
docker-compose exec mysql80 bash

docker-compose exec mariadb bash

docker-compose exec golang bash
```

### Working Directory
All the containers' working directory is [www](www).

## Restart the containers
```shell
docker-compose restart nginx
docker-compose restart mysql80
```

Or just restart all services. If you have changed the service's configurations, stop all services first to avoid read the old settings.
```shell
docker-compose down
docker-compose up -d
```

## Services


### Nginx 
| Version |
| ------- |
| latest  |

Store your nginx configurations in the [conf folder](\services\nginx\conf.d\template) folder using a file extension of ``conf.template``. After create or edit the conf file you need to restart the service.
```shell
docker-compose down
docker-compose up -d
```

#### Default configurations

| File                         | URL                             |
| ---------------------------- | ------------------------------- |
| phpinfo-site.conf.template   | http://127.0.0.1:81/phpinfo/5.6 <br/> http://127.0.0.1:81/phpinfo/7.1 <br/> http://127.0.0.1:81/phpinfo/7.4 <br/> http://127.0.0.1:81/phpinfo/8.0 <br/> http://127.0.0.1:81/phpinfo/8.1 <br/> http://127.0.0.1:81/phpinfo/8.2 |
| phpinfo-ssl.conf.template    | https://127.0.0.1:8143/phpinfo/5.6 <br/> https://127.0.0.1:8143/phpinfo/7.1 <br/> https://127.0.0.1:8143/phpinfo/7.4 <br/> https://127.0.0.1:8143/phpinfo/8.0 <br/> https://127.0.0.1:8143/phpinfo/8.1 <br/> https://127.0.0.1:8143/phpinfo/8.2 |
| default-site.conf.template   | http://127.0.0.1:82            |
| default-ssl.conf.template    | https://127.0.0.1:443          |
| phpinfo-swoole.conf.template | https://127.0.0.1:7001/7.4 <br/> https://127.0.0.1:7001/8.0 <br/> https://127.0.0.1:7001/8.1 <br/> https://127.0.0.1:7001/8.2 |
| default-swoole.conf.template | https://127.0.0.1:847 |

### PHP
| Version | Swoole   | ImageMagick   |
| ------- | :------: | :-----------: |
| 5.6     |          |               |
| 7.1     |          | v             |
| 7.4     | v        | v             |
| 8.0     | v        | v             |
| 8.1     | v        | v             |
| 8.2     | v        | v             |

#### Enter Container
```shell
docker-compose exec php71 /bin/sh
docker-compose exec php74 /bin/sh
docker-compose exec php80 /bin/sh
docker-compose exec php81 /bin/sh
docker-compose exec php82 /bin/sh
```

#### Laravel
1. After entering the php container, this command can install the laravel project.
    ```shell
    composer create-project --prefer-dist laravel/laravel blog
    ```
2. Create the [conf file](services\nginx\conf.d\template\default-site.conf.template) in nginx.

#### Swoole
1. After entering the php container, run the swoole file.
    ```shell
    php swoole.php
    ```
2. Create the [conf file](services\nginx\conf.d\template\default-swoole.conf.template) in nginx.


#### ImageMagick
1. Run the [test.sh](www\imagick\test.sh) for testing the ImageMagick commands.
    ```shell
    docker-compose exec php80 /bin/sh
    cd ../imagick
    sh test.sh
    ```

### Mysql
| Version | phpmyadmin |
| ------- | ---------- |
| 5.7     | v          |
| 8.0     | v          |

#### Environment variables
| configuration        | variable                   | default |
| -------------------- | -------------------------- | ------- |
| port of mysql 5.7    | MYSQL_57_PORT              | 4306    |
| port of mysql 8.0    | MYSQL_80_PORT              | 5306    |
| allow empty password | MYSQL_ALLOW_EMPTY_PASSWORD | yes     |
| root password        | MYSQL_ROOT_PASSWORD        | (empty) |

#### Container
You can choose any version of mysql you want. And the working directory is [www](www), put the sql files in this folder for importing easily.

```shell
docker-compose exec mysql57 bash
```

Another way to connect the mysql service without entering the container is using the mysql client command.
```shell
mysql --host=localhost --port=6306 -uroot --default-character-set=utf8
```

### mariadb
| Version | phpmyadmin |
| ------- | ---------- |
| 10.2.10 | v          |

#### Environment variables
| configuration | variable        | default |
| ------------- | --------------- | ------- |
| port          | MARIADB_PORT    | 6306    |

#### Container
The working directory is [www](www), put the sql files in this folder for importing easily.

```shell
docker-compose exec mariadb bash
```

### Redis
| Version | phpredisadmin |
| ------- | ------------- |
| latest  | v             |

#### Environment variables

| configuration | variable   | default |
| ------------- | ---------- | ------- |
| port          | REDIS_PORT | 6379    |

#### Container

```shell
docker-compose exec redis /bin/sh

redis-cli --raw
```

### phpmyadmin
#### Environment variables
- [config.inc.php](https://github.com/phpmyadmin/docker/blob/master/config.inc.php)

| configuration | variable        | default |
| ------------- | --------------- | ------- |
| port          | PHPMYADMIN_PORT | 81      |


### phpredisadmin
#### Environment variables

| configuration | variable          | default |
| ------------- | ----------------- | ------- |
| port          | REDISMYADMIN_PORT | 82      |


### SSL
```shell
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout ssl.key -out ssl.csr
```


### Golang

| Version | Tesseract OCR | ImageMagick   |
| ------- | :-----------: | :-----------: |
| latest  | v             |               |

#### Container
After enter the container the working directory is [www](www).

```shell
docker-compose exec golang bash
```

#### tesseract
```shell
tesseract --version
```