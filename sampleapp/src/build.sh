#!/bin/bash
set -e

echo "Build script started."

# 1. Instal Composer
echo "Installing Composer..."
# Dapatkan installer Composer, jalankan, lalu hapus installer-nya
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
echo "Composer installed."

# 2. Buat direktori yang bisa ditulis di dalam /tmp
echo "Creating writable directories..."
mkdir -p /tmp/storage/framework/sessions /tmp/storage/framework/views /tmp/storage/framework/cache/data /tmp/storage/logs /tmp/bootstrap/cache

# 3. Jalankan Composer install menggunakan file composer.phar yang baru diunduh
echo "Running Composer install..."
php composer.phar install --no-dev --optimize-autoloader

# 4. Jalankan perintah Artisan
echo "Running Artisan commands..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build finished successfully!"