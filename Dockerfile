FROM php:8.2-apache

RUN a2enmod rewrite \
    && sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf \
    && sed -i "s/Listen 80/Listen 10000/g" /etc/apache2/ports.conf \
    && sed -i "s/:80>/:10000>/g" /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . /var/www/html/

EXPOSE 10000
