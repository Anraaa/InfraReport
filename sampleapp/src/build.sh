#!/bin/bash
set -e

echo "Build script started."

echo "Checkpoint 1: Creating writable directories..."
mkdir -p /tmp/storage/framework/sessions /tmp/storage/framework/views /tmp/storage/framework/cache/data /tmp/storage/logs /tmp/bootstrap/cache
echo "Checkpoint 2: Directories created."

echo "Checkpoint 3: Starting Composer install..."
composer install --no-dev --optimize-autoloader
echo "Checkpoint 4: Composer install finished."

echo "Checkpoint 5: Starting Artisan commands..."
php artisan config:cache
echo "Checkpoint 6: config:cache finished."
php artisan route:cache
echo "Checkpoint 7: route:cache finished."
php artisan view:cache
echo "Checkpoint 8: view:cache finished."

echo "Build finished successfully!"