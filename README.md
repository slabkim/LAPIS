# Portal LAPIS

**Layanan Aspirasi dan Pengaduan Imigrasi Seketika**

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

## 📖 Tentang Proyek

Portal LAPIS adalah sistem aplikasi web yang dirancang untuk memfasilitasi layanan pengaduan dan survei kepuasan masyarakat terhadap layanan imigrasi. Platform ini menyediakan kanal komunikasi dua arah antara masyarakat dan administrator untuk meningkatkan kualitas layanan imigrasi.

### 🎯 Tujuan Utama

-   Memberikan kemudahan masyarakat dalam menyampaikan pengaduan terkait layanan imigrasi
-   Monitoring dan pengelolaan pengaduan secara sistematis
-   Mengukur tingkat kepuasan masyarakat terhadap layanan imigrasi
-   Meningkatkan transparansi dan akuntabilitas pelayanan publik

## ✨ Fitur Utama

### 👥 Panel User (Masyarakat)

-   **Autentikasi Multi-Opsi**

    -   Registrasi dan login dengan email/password
    -   Login menggunakan Google OAuth
    -   Verifikasi email untuk keamanan

-   **Pengaduan Layanan**

    -   **Pengaduan Pungli/Calo**: Laporan terkait pungutan liar atau percaloan
    -   **Pengaduan Keterlambatan**: Laporan terkait keterlambatan layanan
    -   Upload lampiran/bukti pendukung
    -   Tracking status pengaduan secara real-time

-   **Survei Kepuasan**

    -   Isian survei kepuasan layanan berbasis kategori
    -   Penilaian terhadap berbagai aspek layanan

-   **Manajemen Profil**
    -   Update data pribadi
    -   Ubah password
    -   Hapus akun

### 🔐 Panel Admin

-   **Dashboard Analitik**

    -   Statistik pengaduan (total, proses, selesai)
    -   Visualisasi data dengan grafik dan chart
    -   Overview performa layanan

-   **Manajemen Pengaduan**

    -   List pengaduan pungli/calo dan keterlambatan
    -   Detail pengaduan lengkap dengan lampiran
    -   Update status pengaduan (Menunggu, Diproses, Selesai)
    -   Filter dan pencarian pengaduan

-   **Survei & Analisis**

    -   Melihat hasil survei kepuasan masyarakat
    -   Analisis data survei untuk evaluasi layanan

-   **Master Data**

    -   Kelola jenis layanan imigrasi
    -   Manajemen kategori pengaduan

-   **Log Aktivitas**
    -   Tracking aktivitas admin untuk audit trail

## 🛠️ Teknologi yang Digunakan

### Backend

-   **Framework**: Laravel 10.x
-   **PHP**: 8.1+
-   **Database**: MySQL 8.0
-   **Authentication**: Laravel Breeze + Laravel Socialite (Google OAuth)
-   **Authorization**: Multi-guard Authentication (User & Admin)

### Frontend

-   **CSS Framework**: TailwindCSS 3.x
-   **Build Tool**: Vite
-   **Template Engine**: Blade
-   **JavaScript**: Vanilla JS dengan Alpine.js (dari Breeze)

### Packages & Libraries

-   **guzzlehttp/guzzle**: HTTP client untuk API requests
-   **laravel/sanctum**: API authentication
-   **laravel/socialite**: OAuth authentication (Google)
-   **fakerphp/faker**: Data seeding untuk development

## 📋 Persyaratan Sistem

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL >= 8.0
-   Web Server (Apache/Nginx)
-   Extension PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd Portal-LAPIS
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_lapis
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Google OAuth (Opsional)

Tambahkan kredensial Google OAuth di `.env`:

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
```

### 6. Migrasi Database & Seeding

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk data awal (kategori, admin, dll)
php artisan db:seed
```

### 7. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Aplikasi

```bash
# Menggunakan Laravel built-in server
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 🔑 Default Credentials

### Admin

-   **Email**: admin@lapis.com (sesuaikan dengan seeder)
-   **Password**: password

## 📁 Struktur Database

### Tabel Utama

-   **users**: Data pengguna/masyarakat
-   **admins**: Data administrator
-   **kategori_pengaduan**: Kategori pengaduan
-   **jenis_layanan**: Jenis layanan imigrasi
-   **pengaduan_pungli_calo**: Pengaduan pungli/calo
-   **pengaduan_keterlambatan**: Pengaduan keterlambatan
-   **lampiran**: Lampiran/bukti pendukung
-   **survei**: Data survei kepuasan
-   **log_admins**: Log aktivitas admin

## 🔄 Workflow Pengaduan

1. **User** melakukan login/registrasi
2. **User** mengisi form pengaduan (Pungli/Keterlambatan)
3. **User** melampirkan bukti (opsional)
4. **Sistem** menyimpan pengaduan dengan status "Menunggu"
5. **Admin** melihat pengaduan di dashboard
6. **Admin** memproses pengaduan dan update status
7. **User** dapat melihat update status pengaduan

## 📊 Workflow Survei

1. **User** login ke sistem
2. **User** mengakses halaman survei
3. **User** mengisi penilaian untuk setiap kategori layanan
4. **Sistem** menyimpan hasil survei
5. **Admin** dapat melihat analisis hasil survei

## 🧪 Testing

```bash
# Jalankan test
php artisan test

# Dengan coverage
php artisan test --coverage
```

## 🔒 Security Features

-   CSRF Protection (built-in Laravel)
-   XSS Protection
-   SQL Injection Protection (Eloquent ORM)
-   Email Verification untuk user baru
-   Password Hashing (bcrypt)
-   Multi-guard Authentication
-   Middleware Authorization

## 📱 Browser Support

-   Chrome (latest)
-   Firefox (latest)
-   Safari (latest)
-   Edge (latest)

## 🤝 Contributing

Jika Anda ingin berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Proyek ini menggunakan lisensi [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Dikembangkan dengan ❤️ menggunakan Laravel Framework

## 📞 Kontak & Support

Untuk pertanyaan atau bantuan, silakan hubungi tim pengembang atau buat issue di repository ini.

---

**Portal LAPIS** - Meningkatkan Kualitas Layanan Imigrasi Melalui Partisipasi Masyarakat
