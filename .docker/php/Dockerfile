FROM php:8.4-fpm

# Instala dependências para extensões e XDebug
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git unzip libzip-dev libpng-dev zlib1g-dev && \
    docker-php-ext-install pdo pdo_mysql zip

# Instala XDebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
