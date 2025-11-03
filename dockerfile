# Laravel üçün PHP 8.2 image istifadə edirik
FROM php:8.2-apache

# Sistem tələblərini quraşdıraq
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git curl

# Composer-i quraşdıraq
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel fayllarını köçür
WORKDIR /var/www/html
COPY . .

# Composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel key və cache əmrləri
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache

# Apache üçün document root-u dəyiş
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# Apache mod_rewrite aktiv et
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
