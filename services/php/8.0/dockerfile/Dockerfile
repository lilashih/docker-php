FROM php:8.0-fpm-alpine

RUN apk add --update \
        npm \
        git \
        libzip-dev \
        libressl-dev \
        freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        libjpeg-turbo-dev \
        linux-headers \
        openssl \
        openssl-dev \
        ffmpeg \
        libxml2-dev \
        imagemagick-dev \
        imagemagick \
        libtool \
        $PHPIZE_DEPS \
    && pecl install xdebug-3.2.0 swoole-5.0.2 redis imagick mongodb \
    && docker-php-ext-install pdo pdo_mysql zip exif opcache \ 
    && docker-php-ext-enable xdebug opcache swoole redis imagick mongodb \
    # composer
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