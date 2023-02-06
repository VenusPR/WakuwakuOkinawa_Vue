FROM php:8.0.25

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install Node.js
# 変更　COPY --from=node:10.22 -> COPY --from=node:lts (long time support)
COPY --from=node:lts /usr/local/bin /usr/local/bin
COPY --from=node:lts /usr/local/lib /usr/local/lib

RUN apt-get update && \
    apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    procps \
    && docker-php-ext-install pdo_mysql bcmath

# install pnpm
RUN npm install -g pnpm@latest

WORKDIR /var/www/html

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
