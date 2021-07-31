FROM php:7.1-fpm-alpine

RUN apk add --update \
        libzip-dev \
        npm \
        git \
        freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        libjpeg-turbo-dev \
        $PHPIZE_DEPS \
    && pecl install xdebug-2.6.0 redis \
    && docker-php-ext-install pdo pdo_mysql zip \ 
    && docker-php-ext-enable xdebug redis \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-png=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*
WORKDIR /var/www/html/7.1