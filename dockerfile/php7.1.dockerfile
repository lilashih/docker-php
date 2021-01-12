FROM php:7.1-fpm-alpine

RUN apk add --update \
        libzip-dev \
        npm \
        git \
        $PHPIZE_DEPS \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-install pdo pdo_mysql zip \ 
    && docker-php-ext-enable xdebug \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html