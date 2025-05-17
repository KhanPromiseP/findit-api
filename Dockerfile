FROM php:8.2-fpm

# Install system dependencies and PostgreSQL client dev
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl



# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache


RUN php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Migrate database (optional)
RUN php artisan migrate --force
RUN php artisan db:seed --force


EXPOSE 8000

COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]

