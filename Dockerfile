FROM php:8.2-fpm

# Install system dependencies, Node.js, and Nginx
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpq-dev \
    gnupg2 nginx \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy package files first for better caching
COPY package.json package-lock.json ./

# Install Node modules
RUN npm install && npm cache clean --force

# Copy application code
COPY . .

# Build frontend assets
RUN npm run build && rm -rf node_modules

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && composer dump-autoload --optimize \
    && rm -rf /root/.composer/cache

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

COPY /full/path/to/nginx.conf /etc/nginx/conf.d/default.conf

# Application setup
RUN php artisan storage:link \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/health-check || exit 1

EXPOSE 80

# Start both Nginx and PHP-FPM
CMD bash -c "php-fpm -D && nginx -g 'daemon off;'"

COPY start.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/start.sh
CMD ["/usr/local/bin/start.sh"]