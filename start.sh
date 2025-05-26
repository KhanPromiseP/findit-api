#!/bin/bash


echo "Waiting for the database..."
sleep 10


php artisan migrate --force
php artisan db:seed --force


php artisan serve --host=0.0.0.0 --port=8000

