FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql \ 
    && apk add --update \
        npm \
        git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html