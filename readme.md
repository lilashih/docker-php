# Docker Compose
Building the development environment quickly.

## .env
Copy the .env.example file to .env.

## Run
### First installation
```shell
docker-compose build
docker-compose up -d

# Build the specific image
docker-compose build php71
docker-compose build golang
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
| default-site.conf.template   | http://127.0.0.1:1001/phpinfo <br/> http://127.0.0.1:1001/opcache |
| default-ssl.conf.template    | https://127.0.0.1:1002/phpinfo <br/> http://127.0.0.1:1002/opcache |
| default-swoole.conf.template | https://127.0.0.1:1003/7.4 <br/> https://127.0.0.1:1003/8.0 <br/> https://127.0.0.1:1003/8.1 <br/> https://127.0.0.1:1003/8.2 |
| project-site.conf.template   | http://127.0.0.1:1011           |
| project-ssl.conf.template    | https://127.0.0.1:1012          |
| project-swoole.conf.template | https://127.0.0.1:1013          |

#### Environment variables

| variable                 | default |
| ------------------------ | ------- |
| PHPINFO_PORT             | 1001    |
| PHPINFO_SSL_PORT         | 1002    |
| PHPINFO_SWOOLE_PORT      | 1003    |
| DEFAULT_SITE_PORT        | 1011    |
| DEFAULT_SITE_SSL_PORT    | 1012    |
| DEFAULT_SITE_SWOOLE_PORT | 1013    |


### PHP
| Version | Swoole   | ImageMagick   | Opache |
| ------- | :------: | :-----------: | :----: |
| 5.6     |          |               |        |
| 7.1     |          | v             |        |
| 7.4     | v        | v             | v      |
| 8.0     | v        | v             | v      |
| 8.1     | v        | v             | v      |
| 8.2     | v        | v             | v      |

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
2. Create the [conf file](services\nginx\conf.d\template\project-laravel.conf.template) in nginx.

#### Swoole
1. After entering the php container, run the [swoole.php](www\default\public\swoole.php).
    ```shell
    php swoole.php
    ```
2. Create the [conf file](services\nginx\conf.d\template\project-swoole.conf.template) in nginx.


#### ImageMagick
1. Run the [test.sh](www\imagick\test.sh) for testing the ImageMagick commands.
    ```shell
    docker-compose exec php80 /bin/sh
    cd ../imagick
    sh test.sh
    ```



### supervisor
#### Environment variables

| configuration | variable          | default |
| ------------- | ----------------- | ------- |
| web ui port   | SUPERVISOR_PORT   | 1040    |

#### Enter Container
```shell
docker-compose exec supervisor bash
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
mysql -u root -p
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