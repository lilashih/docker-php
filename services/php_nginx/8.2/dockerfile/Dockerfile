FROM php:8.2-fpm-alpine

ARG VOLUME_ROOT=.

RUN apk add --update \
      nginx \
      supervisor \
      npm \
      linux-headers \
      libzip-dev \
      openssl \
      openssl-dev \
      $PHPIZE_DEPS \
    && pecl channel-update pecl.php.net \
    && pecl install xdebug mongodb \
    && docker-php-ext-install pdo pdo_mysql zip exif opcache \
    && docker-php-ext-enable opcache mongodb xdebug \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /var/cache/apk/*

COPY ${VOLUME_ROOT}/conf.d/nginx.conf /etc/nginx/http.d/default.conf

COPY ${VOLUME_ROOT}/conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]