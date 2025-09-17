# InfraReport

InfraReport adalah platform sederhana untuk pelaporan yang cepat, aman, dan transparan. Proyek ini dibuat sebagai media pembelajaran, mengimplementasikan teknologi modern untuk membangun sistem pengaduan yang lebih efisien.

## 🚀 Demo

Kalian dapat mencoba demo aplikasi di link berikut:
👉 (tidak tersedia)

## 🔧 Teknologi yang Digunakan
- **PHP** (Backend utama)
- **Laravel** (Framework PHP)
- **FilamentPHP** (Dashboard Admin)
- **Tailwind CSS** (Styling UI)
- **MySQL** / **MariaDB** (Database)
- **Docker & Docker Compose** (Pengelolaan container)
- **Cloudinary** (Penyimpanan gambar berbasis cloud)


## 📜 Fitur Utama
- Pengguna dapat membuat laporan dengan mudah.
- Status laporan dapat dipantau secara real-time.
- Admin dapat mengelola laporan dan memberikan tanggapan.
- UI yang responsif dengan Tailwind CSS.
- Sistem berbasis Laravel dengan keamanan yang lebih baik.

📦 Instalasi
Jika ingin menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut.

📋 Prasyarat
Git

Docker & Docker Compose

1️⃣ Clone Repository & Siapkan Konfigurasi
Bash

### Clone repository
`git clone <repo_url>`

### Masuk ke direktori utama
`cd infrareport`

### Masuk ke direktori aplikasi
`cd sampleapp`

### Salin file environment. Langkah ini penting sebelum menyalakan Docker
# agar database terinisialisasi dengan benar.
```
cp .env.example .env
Setelah menyalin, buka file .env dan sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) agar cocok dengan environment di file docker-compose.yml Anda.
```

2️⃣ Build & Jalankan Container Docker
Perintah ini akan membangun image dan menyalakan semua layanan (Nginx, PHP, MariaDB) di latar belakang.

Bash

`docker compose up -d --build`
3️⃣ Jalankan Perintah Setup di Dalam Container
Semua perintah composer dan artisan harus dijalankan di dalam container PHP (sample).

### Install dependensi PHP

```
docker exec -it sample bash
composer install
```

### Generate kunci aplikasi Laravel
`php artisan key:generate`

# Buat link dari storage ke folder public
`php artisan storage:link`

# Jalankan migrasi dan seeding database
`php artisan migrate --seed`

4️⃣ Atur Izin Akses Folder
Ini adalah langkah krusial untuk menghindari error 500. Perintah ini memberikan izin kepada server untuk menulis file log dan cache.


docker exec -it sample 
```
chown -R www-data:www-data storage/* 
chown -R www-data:www-data bootstrap/cache
```

5️⃣ Selesai! Akses Aplikasi
Sekarang Anda bisa membuka browser dan mengakses website

---

## 📌 Catatan
- **Akses Admin:** Tidak tersedia untuk umum dalam demo.
- **Tujuan:** Hanya sebagai pembelajaran, bukan untuk penggunaan produksi.

## 🤝 Kontribusi
Jika ingin berkontribusi dalam proyek ini, silakan fork repository dan kirimkan pull request.

---

💡 Dibangun dengan ❤️ menggunakan **Laravel**, **Filament**, dan **Tailwind CSS**.

