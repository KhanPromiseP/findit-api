FROM php:8.2-fpm

# Install system dependencies and nodejs + npm
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpq-dev \
    gnupg2 \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy package.json and package-lock.json first to leverage Docker cache for npm install
COPY package.json package-lock.json ./

# Install node modules
RUN npm install

# Copy application code
COPY . .


# Build frontend assets
RUN npm run build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions (combine chmod and chown)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Cache config and routes (after permissions)
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link

EXPOSE 8000

COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
