FROM php:8.2-fpm-alpine

WORKDIR /var/www/html/public

RUN docker-php-ext-install pdo pdo_my_sql