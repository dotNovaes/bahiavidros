FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpq-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql gd \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY composer.json composer.lock composer.phar index.php ler-produtos-view.php ./
COPY src ./src
COPY .env ./.env

RUN php composer.phar install --no-dev --optimize-autoloader --no-interaction \
    && mkdir -p /var/www/html/arquivo /var/www/html/src/back/arquivo \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80
