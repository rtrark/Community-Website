FROM php:7.4-fpm-bullseye

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    git unzip zip libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev libgmp-dev \
    libxml2-dev libonig-dev libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring xml curl gd zip bcmath gmp opcache \
    && rm -rf /var/lib/apt/lists/*

COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www
CMD ["php-fpm"]
