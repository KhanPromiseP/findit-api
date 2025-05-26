

#!/bin/bash
php-fpm -D
nginx -g 'daemon off;'

# Wait for database to be ready (more robust version)
echo "Waiting for database..."
max_retries=10
count=0

while ! php artisan db:monitor >/dev/null 2>&1; do
  count=$((count+1))
  if [ $count -ge $max_retries ]; then
    echo "Database connection failed after $max_retries attempts"
    exit 1
  fi
  echo "Retry $count/$max_retries..."
  sleep 5
done

# Run migrations and seeds (only in production)
if [ "$APP_ENV" = "production" ]; then
  php artisan migrate --force
  php artisan db:seed --force
fi

# Clear and cache configurations
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM (instead of artisan serve for production)
exec php-fpm
