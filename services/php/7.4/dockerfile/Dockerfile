FROM php:7.4-fpm-alpine

ARG XDEBUG_VERSION=3.1.6
ARG SWOOLE_VERSION=4.8.13

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
        postgresql-dev \
        $PHPIZE_DEPS \
    && pecl channel-update pecl.php.net \
    && pecl install xdebug-${XDEBUG_VERSION} swoole-${SWOOLE_VERSION} redis imagick \
    && docker-php-ext-install pdo pdo_mysql mysqli zip exif opcache pgsql pdo_pgsql \ 
    && docker-php-ext-enable xdebug swoole redis imagick opcache \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin" \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html