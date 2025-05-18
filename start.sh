#!/bin/bash

# Wait for DB to be ready
echo "Waiting for the database..."
sleep 10

# Run migrations and seeds
php artisan migrate --force
php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000

