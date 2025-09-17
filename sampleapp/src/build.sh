#!/bin/bash

# Hentikan proses jika ada error
set -e

echo "Build script started..."

# 1. Buat semua direktori yang bisa ditulis di dalam /tmp
echo "Creating writable directories in /tmp..."
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/framework/cache/data
mkdir -p /tmp/storage/logs
mkdir -p /tmp/bootstrap/cache

# 2. Jalankan Composer untuk menginstal dependensi
echo "Running Composer install..."
composer install --no-dev --optimize-autoloader

# 3. Jalankan perintah Artisan
# Sekarang aman untuk menjalankan config:cache karena path bootstrap/cache sudah bisa ditulis
echo "Running Artisan commands..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build finished successfully!"