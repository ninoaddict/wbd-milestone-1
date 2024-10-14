FROM php:8.3-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

COPY ./php/src /var/www/html

RUN chown -R www-data:www-data /var/www/html
