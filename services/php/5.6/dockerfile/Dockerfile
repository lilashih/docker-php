FROM php:5.6-fpm-alpine

RUN apk add --update \
        npm \
        git \
    && docker-php-ext-install pdo pdo_mysql \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html