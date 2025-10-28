FROM php:7.1-fpm-alpine

ARG XDEBUG_VERSION=2.9.8
ARG IMAGICK_VERSION=3.4.3

RUN apk add --update \
        npm \
        git \
        libzip-dev \
        freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        libjpeg-turbo-dev \
        openssl \
        openssl-dev \
        ffmpeg \
        libxml2-dev \
        shadow \
        imagemagick-dev \
        imagemagick \
        libtool \
        postgresql-dev \
        $PHPIZE_DEPS \
    && pecl channel-update pecl.php.net \
    && pecl install xdebug-${XDEBUG_VERSION} imagick-${IMAGICK_VERSION} \
    && docker-php-ext-install pdo pdo_mysql mysqli zip exif pgsql pdo_pgsql \ 
    && docker-php-ext-enable xdebug imagick \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin" \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-png=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*  \
    && rm -rf /var/cache/apk/*

ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html