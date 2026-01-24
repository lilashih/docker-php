FROM php:7.2-fpm-alpine

# 定義版本變數
ARG XDEBUG_VERSION=2.9.8
ARG IMAGICK_VERSION=3.4.4

# 設定環境變數
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# 安裝運行時必要的套件 (Runtime Dependencies)
# 這些套件是 PHP 執行時需要的，不能被刪除
RUN apk add --update \
        npm \
        git \
        freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        linux-headers \
        openssl \
        ffmpeg \
        imagemagick \
        libtool \
    \
    # 安裝編譯時需要的臨時套件 (Build Dependencies)
    # 使用 .build-deps 標籤以便後續一次性刪除
    && apk add --update --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        linux-headers \
        libzip-dev \
        libpng-dev \
        libressl-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        imagemagick-dev \
        postgresql-dev \
        openssl-dev \
        libxml2-dev \
    \
    # 安裝 PECL 擴展
    && pecl channel-update pecl.php.net \
    \
    # 配置並安裝 PHP 內置擴展
    && pecl install xdebug-${XDEBUG_VERSION} imagick-${IMAGICK_VERSION} \
    && docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mysqli zip exif opcache pgsql pdo_pgsql gd \
    && docker-php-ext-enable xdebug imagick opcache \
    \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin" \
    && composer self-update 1.10.15 \
    \
    # 清理刪除所有編譯用的臨時套件與暫存檔
    && apk del .build-deps \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html