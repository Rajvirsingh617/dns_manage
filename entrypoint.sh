#!/bin/bash

echo "Clearing Laravel caches and starting fresh..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan clear-compiled
php artisan optimize:clear

echo "Refreshing database..."
php artisan migrate:refresh --seed

echo "Reinstalling dependencies..."
composer install
npm install && npm run dev

echo "All done. Laravel is reset!"

# Start the supervisor to manage Apache and CoreDNS
exec /usr/bin/supervisord -n