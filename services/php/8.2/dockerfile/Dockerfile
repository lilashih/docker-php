FROM php:8.2-fpm-alpine

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
        libjpeg-turbo-dev \
        freetype-dev \
        imagemagick-dev \
        openssl-dev \
        libxml2-dev \
    \
    # 安裝 PECL 擴展
    && pecl channel-update pecl.php.net \
    \
    # 配置並安裝 PHP 內置擴展
    && pecl install xdebug swoole redis imagick mongodb \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql zip exif opcache gd \
    && docker-php-ext-enable opcache xdebug swoole redis imagick mongodb \
    \
    # composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && export PATH="$PATH:/root/.composer/vendor/bin" \
    # 清理刪除所有編譯用的臨時套件與暫存檔
    && apk del .build-deps \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html