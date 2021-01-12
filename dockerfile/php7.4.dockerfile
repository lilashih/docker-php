FROM php:7.4-fpm-alpine

RUN apk add --update \
        libzip-dev \
        npm \
        git \
    && docker-php-ext-install pdo pdo_mysql zip \ 
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html