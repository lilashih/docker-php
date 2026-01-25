FROM php:7.4-fpm-alpine

ENV PATH="/root/.composer/vendor/bin:${PATH}"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
    && apk add --update --no-cache \
        npm \
        git \
        ffmpeg \
        openssl \
        libtool \
        libzip \
    && install-php-extensions \
        xdebug \
        imagick \
        mysqli \
        pgsql \
        pdo_mysql \
        pdo_pgsql \
        zip \
        exif \
        opcache \
        gd \
        bcmath \
        mongodb \
        pcntl \
        swoole \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin"

WORKDIR /var/www/html