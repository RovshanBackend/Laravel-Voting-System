FROM php:8.2-apache

# Lazımi PHP extensiyaları
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libzip-dev zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer quraşdır
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Composer əmri
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Laravel əmrləri
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache

# Apache konfiqurasiyası
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
