# 🚂 Railway Deployment Guide - Portal LAPIS

## 📋 Pre-requisites

1. **Railway Account** - Sign up di [railway.app](https://railway.app)
2. **Supabase Database** - Setup database (sudah dilakukan)
3. **GitHub Repository** - Project sudah di push

## 🚀 Deployment Steps

### 1. Create New Project di Railway

1. Login ke [Railway Dashboard](https://railway.app/dashboard)
2. Klik **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Authorize Railway untuk akses GitHub Anda
5. Pilih repository: **`slabkim/LAPIS`**
6. Klik **"Deploy Now"**

### 2. Setup Environment Variables

Di Railway Dashboard → Project → Variables tab, tambahkan:

```env
# Application
APP_NAME="Portal LAPIS"
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Database (Supabase)
DB_CONNECTION=pgsql
DB_HOST=aws-1-ap-northeast-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.kixsszfwsbcksssytsrh
DB_PASSWORD=@Slabkim11223
DB_SCHEMA=public
DB_SSLMODE=require

# Google OAuth (opsional)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=https://your-app.railway.app/auth/google/callback

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Optional: Database Seeding
DATABASE_SEED=false
```

**⚠️ PENTING:**

1. **Generate APP_KEY baru** untuk production:

    ```bash
    # Run di local:
    php artisan key:generate --show
    # Copy output dan paste ke Railway
    ```

2. **Ganti `your-app.railway.app`** dengan domain Railway Anda setelah deployment

### 3. Deploy!

Setelah setup environment variables:

1. Railway akan otomatis rebuild dan deploy
2. Tunggu ~3-5 menit
3. Klik **"View Logs"** untuk monitor progress

### 4. Run Database Migration (First Time)

**Opsi A: Via Railway CLI (Recommended)**

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link project
railway link

# Run migrations
railway run php artisan migrate --force

# Seed data (optional, first time only)
railway run php artisan db:seed --force
```

**Opsi B: Via Railway Dashboard**

1. Di Railway Dashboard → Deployments
2. Klik deployment yang aktif
3. Klik **"View Logs"**
4. Migrations akan auto-run via `railway.sh` script

### 5. Access Your App

Setelah deployment sukses:

1. Railway akan provide URL, contoh: `https://portal-lapis-production.up.railway.app`
2. Klik URL atau copy paste ke browser
3. Test login dengan credentials:
    - Email: `admin@lapis.com`
    - Password: `password`

## 🔧 Troubleshooting

### Error: "No version available for php 8.1"

**Solusi:** Sudah diperbaiki! `composer.json` sudah diupdate ke PHP `^8.2`

### Error: "Class 'PDO' not found"

**Solusi:** Sudah ada di `nixpacks.toml`:

```toml
nixPkgs = ["php82", "php82Extensions.pgsql", "php82Extensions.pdo_pgsql"]
```

### Error: "Migration failed"

**Solusi:**

1. Cek environment variables sudah benar
2. Test koneksi database
3. Run migration manual via Railway CLI:
    ```bash
    railway run php artisan migrate:fresh --force
    ```

### Error: "500 Internal Server Error"

**Solusi:**

1. Set `APP_DEBUG=true` sementara untuk lihat error
2. Cek logs di Railway Dashboard
3. Pastikan `APP_KEY` sudah di-set

### Error: "CSRF token mismatch"

**Solusi:**

1. Update `APP_URL` dengan URL Railway yang benar
2. Clear cache:
    ```bash
    railway run php artisan config:clear
    railway run php artisan cache:clear
    ```

## 📝 Files Created for Railway

1. **`nixpacks.toml`** - Nixpacks configuration (PHP version, extensions)
2. **`railway.sh`** - Deployment script (migrations, optimization)
3. **`composer.json`** - Updated PHP requirement to `^8.2`

## 🔄 Re-deploy

Setiap kali push ke GitHub:

```bash
git add .
git commit -m "your message"
git push origin main
```

Railway akan otomatis:

1. Detect changes
2. Rebuild
3. Run `railway.sh` script
4. Deploy new version

## 🎯 Production Checklist

-   [ ] `APP_ENV=production` di Railway
-   [ ] `APP_DEBUG=false` di Railway
-   [ ] `APP_KEY` generated dan di-set
-   [ ] Database credentials benar (Supabase)
-   [ ] `APP_URL` sesuai dengan Railway domain
-   [ ] Google OAuth redirect URI updated (jika pakai)
-   [ ] Migrations berhasil dijalankan
-   [ ] Test login admin berhasil
-   [ ] Test create pengaduan berhasil
-   [ ] Test upload file berhasil

## 💰 Railway Free Tier

Railway Free tier include:

-   **$5 free credit** per bulan
-   **500 hours** execution time
-   Cukup untuk small-medium apps

Jika perlu lebih, upgrade ke **Developer Plan** ($5/month).

## 📚 Resources

-   [Railway Docs](https://docs.railway.app/)
-   [Railway CLI](https://docs.railway.app/develop/cli)
-   [Nixpacks](https://nixpacks.com/)
-   [Deploy Laravel to Railway](https://docs.railway.app/guides/laravel)

---

**Good luck with your deployment!** 🚀

Jika ada error, lihat **Troubleshooting** section atau buka issue.
