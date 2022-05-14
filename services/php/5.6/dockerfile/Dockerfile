FROM php:5.6-fpm-alpine

RUN apk add --update \
        npm \
        git \
    && docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html/5.6