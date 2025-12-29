# 🔧 Troubleshooting Supabase Storage Upload

## Masalah yang Sudah Diperbaiki

### ✅ **1. Status Code Check**

**Before:**

```php
if ($response->getStatusCode() !== 200) {
    throw new \Exception('Failed to upload file to Supabase Storage');
}
```

**After:**

```php
$statusCode = $response->getStatusCode();

// Supabase returns 201 Created on successful upload, not 200
if ($statusCode !== 200 && $statusCode !== 201) {
    $responseBody = $response->getBody()->getContents();
    Log::error('Supabase upload failed', [
        'status' => $statusCode,
        'response' => $responseBody,
        'bucket' => $this->bucket,
        'path' => $filePath
    ]);
    throw new \Exception('Failed to upload file to Supabase Storage: ' . $responseBody);
}
```

**Penjelasan:** Supabase Storage API mengembalikan status **201 Created** saat upload berhasil, bukan 200 OK. Code sebelumnya hanya menerima 200, sehingga semua upload dianggap gagal meskipun sebenarnya sukses!

---

## 📋 Checklist Setup Supabase Storage

Sebelum test upload, pastikan hal-hal berikut sudah dilakukan:

### 1. ✅ Bucket Sudah Dibuat

-   [ ] Login ke Supabase Dashboard: https://supabase.com/dashboard
-   [ ] Buka project Anda
-   [ ] Navigate ke **Storage** di sidebar
-   [ ] Pastikan bucket bernama **`lampiran-pengaduan`** sudah dibuat
-   [ ] **Public bucket** harus di-check agar file bisa diakses public

### 2. ✅ Storage Policies Setup

Jalankan SQL berikut di **SQL Editor** Supabase:

```sql
-- Policy 1: Allow public read access
CREATE POLICY "Allow public read access"
ON storage.objects FOR SELECT
TO public
USING (bucket_id = 'lampiran-pengaduan');

-- Policy 2: Allow authenticated uploads (RECOMMENDED)
CREATE POLICY "Allow authenticated uploads"
ON storage.objects FOR INSERT
TO authenticated
WITH CHECK (bucket_id = 'lampiran-pengaduan');

-- OR Policy 3: Allow public uploads (KURANG AMAN, tapi lebih simple)
-- CREATE POLICY "Allow public uploads"
-- ON storage.objects FOR INSERT
-- TO public
-- WITH CHECK (bucket_id = 'lampiran-pengaduan');
```

**Note:** Pilih Policy 2 (authenticated) atau Policy 3 (public). Policy 2 lebih aman tapi butuh auth token, Policy 3 allow siapa saja upload.

### 3. ✅ Environment Variables

Pastikan di `.env`:

```env
SUPABASE_URL=https://kixsszfwsbcksssytsrh.supabase.co
SUPABASE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
SUPABASE_BUCKET=lampiran-pengaduan
```

**Verify:**

```bash
php artisan tinker
```

```php
config('services.supabase')
// Should output:
// [
//   "url" => "https://kixsszfwsbcksssytsrh.supabase.co",
//   "key" => "eyJhbGci...",
//   "bucket" => "lampiran-pengaduan"
// ]
```

### 4. ✅ Clear Config Cache

```bash
php artisan config:clear
php artisan cache:clear
```

---

## 🧪 Testing Upload

### Test 1: Upload File via Form

1. Buka `http://localhost:9000`
2. Login dengan akun user
3. Buat pengaduan pungli/calo
4. Upload 1 foto (JPG/PNG, < 20MB)
5. Submit form

### Test 2: Check Supabase Dashboard

1. Buka Supabase Dashboard → **Storage** → `lampiran-pengaduan`
2. File seharusnya muncul di folder `pengaduan/pungli/`
3. Format nama file: `1735459234_abc123def456.jpg`

### Test 3: Check Database

```bash
php artisan tinker
```

```php
$lampiran = \App\Models\Lampiran::latest()->first();
$lampiran->path_file;
// Should show: https://kixsszfwsbcksssytsrh.supabase.co/storage/v1/object/public/lampiran-pengaduan/pengaduan/pungli/1735459234_abc123.jpg
```

### Test 4: Access File URL

Copy URL dari database, paste di browser. File seharusnya bisa diakses.

---

## 🐛 Debugging Errors

### Error 1: "Failed to upload file to Supabase"

**Check Laravel Log:**

```bash
tail -f storage/logs/laravel.log
```

**Look for:**

```
[timestamp] local.ERROR: Supabase upload failed
{
  "status": 400,
  "response": "Bucket not found",
  "bucket": "lampiran-pengaduan",
  "path": "pengaduan/pungli/12345_abc.jpg"
}
```

**Solutions:**

-   `"Bucket not found"` → Bucket belum dibuat di Supabase
-   `"403 Forbidden"` → Policy belum di-setup
-   `"401 Unauthorized"` → SUPABASE_KEY salah
-   `"413 Payload too large"` → File > 50MB (max Supabase free tier)

### Error 2: File Upload Tapi Tidak Muncul di Supabase

**Possible Causes:**

1. Upload sebenarnya gagal (silent error)
2. Bucket name salah
3. Network issue

**Check:**

```bash
# Check if exception thrown
grep "Failed to upload file to Supabase" storage/logs/laravel.log
```

### Error 3: File di Supabase Tapi Tidak Bisa Diakses (404)

**Cause:** Public read policy belum di-setup

**Solution:** Jalankan Policy 1 (Allow public read access) di SQL Editor

---

## 📊 Expected Behavior

**Successful Upload Flow:**

1. User submit form dengan file
2. PengaduanController call `SupabaseStorageService->upload()`
3. Guzzle POST ke `https://kixsszfwsbcksssytsrh.supabase.co/storage/v1/object/lampiran-pengaduan/pengaduan/pungli/12345_abc.jpg`
4. Supabase return **201 Created**
5. Service return public URL: `https://...supabase.co/storage/v1/object/public/lampiran-pengaduan/...`
6. URL disimpan ke database table `lampiran`
7. File bisa diakses via URL

---

## 🔍 Quick Diagnostic Commands

```bash
# Clear cache
php artisan config:clear && php artisan cache:clear

# Check config
php artisan tinker
>>> config('services.supabase')

# Test Guzzle connectivity
php artisan tinker
>>> $client = new \GuzzleHttp\Client();
>>> $response = $client->get('https://kixsszfwsbcksssytsrh.supabase.co/storage/v1/bucket/lampiran-pengaduan', [
...     'headers' => ['apikey' => config('services.supabase.key')]
... ]);
>>> $response->getStatusCode(); // Should be 200

# Check recent uploads
>>> \App\Models\Lampiran::latest()->take(5)->get(['path_file', 'created_at'])
```

---

## ✅ Checklist Before Asking for Help

-   [ ] Bucket `lampiran-pengaduan` exists di Supabase Dashboard
-   [ ] Public bucket is checked
-   [ ] Read policy (SELECT) enabled
-   [ ] Upload policy (INSERT) enabled (authenticated or public)
-   [ ] `.env` has correct `SUPABASE_URL`, `SUPABASE_KEY`, `SUPABASE_BUCKET`
-   [ ] Config cache cleared (`php artisan config:clear`)
-   [ ] Laravel log checked for error details (`storage/logs/laravel.log`)
-   [ ] Tested with small file (< 5MB)

---

Kalau semua sudah di-check dan masih error, copy paste isi dari `storage/logs/laravel.log` (bagian error Supabase) untuk analisis lebih lanjut! 🚀
