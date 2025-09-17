#!/bin/bash

# Hentikan proses jika ada error
set -e

echo "Build script started..."

# 1. Buat direktori yang bisa ditulis di dalam /tmp
echo "Creating writable directories in /tmp..."
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/framework/cache/data
mkdir -p /tmp/storage/logs
mkdir -p /tmp/bootstrap/cache

# 2. Jalankan Composer
echo "Running Composer install..."
composer install --no-dev --optimize-autoloader

# 3. Jalankan perintah Artisan
# Sekarang aman untuk menjalankan config:cache karena path sudah benar
echo "Running Artisan commands..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build finished successfully!"