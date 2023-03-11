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
        autoconf \
        g++ \
        make \
        openssl \
        ffmpeg \
        libxml2-dev \
        shadow \
        imagemagick-dev \
        imagemagick \
        libtool \
        $PHPIZE_DEPS \
    && pecl install xdebug-2.9.8 redis imagick-3.4.3 \
    && docker-php-ext-install pdo pdo_mysql zip exif \ 
    && docker-php-ext-enable xdebug redis imagick \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-png=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/* 
WORKDIR /var/www/html