FROM php:7.4-fpm-alpine

RUN apk add --update \
        libzip-dev \
        npm \
        git \
        freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        libjpeg-turbo-dev \
        autoconf \
        g++ \
        make \
        gcc \
        linux-headers \
        openssl \
        ffmpeg \
        libxml2-dev \
        imagemagick-dev \
        imagemagick \
        libtool \
        $PHPIZE_DEPS \
    && pecl install xdebug-3.1.6 swoole-4.8.13 redis imagick \
    && docker-php-ext-install pdo pdo_mysql zip exif opcache \ 
    && docker-php-ext-enable xdebug swoole redis imagick opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*
WORKDIR /var/www/html