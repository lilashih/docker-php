FROM php:8.2-fpm-alpine

RUN apk add --update \
        npm \
        git \
        libzip-dev \
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
    && pecl channel-update pecl.php.net \
    && pecl install xdebug swoole redis imagick mongodb \
    && docker-php-ext-install pdo pdo_mysql zip exif opcache \ 
    && docker-php-ext-enable opcache xdebug swoole redis imagick mongodb \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin" \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    # ioncube loader
    && curl -fSL http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o ioncube.tar.gz \
    && mkdir -p ioncube \
    && tar -xf ioncube.tar.gz -C ioncube --strip-components=1 \
    && rm ioncube.tar.gz \
    && mv ioncube/ioncube_loader_lin_8.2.so /usr/local/lib/php/extensions/ioncube_loader_lin_8.2.so \
    && rm -r ioncube \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html