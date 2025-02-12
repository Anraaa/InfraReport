# InfraReport

InfraReport adalah platform sederhana untuk pelaporan yang cepat, aman, dan transparan. Proyek ini dibuat sebagai media pembelajaran, mengimplementasikan teknologi modern untuk membangun sistem pengaduan yang lebih efisien.

## 🚀 Demo

Kalian dapat mencoba demo aplikasi di link berikut:
👉 [InfraReport Demo](https://anra.my.id/)

> **Catatan:** Jika link tidak dapat diakses, kemungkinan layanan ngrok sedang offline.

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

## 📦 Instalasi

Jika ingin menjalankan proyek ini secara lokal, ikuti langkah berikut:

### 1️⃣ Clone Repository & Masuk Direktori SampleApp
```sh
git clone <repo_url>
cd infrareport
cd sampleapp
```

### 2️⃣ Build & Jalankan Docker
```sh
docker compose up -d --build
```

### 3️⃣ Buat & Konfigurasi Environment
Salin file `.env.example` menjadi `.env` lalu atur konfigurasi database.
```sh
cp .env.example .env
```

### 4️⃣ Install Dependencies
```sh
composer install
npm install
```

### 5️⃣ Generate Key & Migrate Database
```sh
php artisan key:generate
php artisan migrate --seed
```

### 6️⃣ Jalankan Aplikasi
```sh
php artisan serve
```
Akses aplikasi di `http://localhost`

## 📌 Catatan
- **Akses Admin:** Tidak tersedia untuk umum dalam demo.
- **Tujuan:** Hanya sebagai pembelajaran, bukan untuk penggunaan produksi.

## 🤝 Kontribusi
Jika ingin berkontribusi dalam proyek ini, silakan fork repository dan kirimkan pull request.

---

💡 Dibangun dengan ❤️ menggunakan **Laravel**, **Filament**, dan **Tailwind CSS**.

