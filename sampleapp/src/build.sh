#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "Build script started..."

# 1. Create all necessary writable directories inside /tmp
echo "Creating writable directories in /tmp..."
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/framework/cache/data
mkdir -p /tmp/storage/logs
mkdir -p /tmp/bootstrap/cache

# 2. Run Composer to install dependencies
echo "Running Composer install..."
composer install --no-dev --optimize-autoloader

# 3. Run Artisan commands
# It is now safe to run config:cache because the bootstrap/cache path is writable
echo "Running Artisan commands..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build finished successfully!"