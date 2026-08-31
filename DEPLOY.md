# Panduan Deployment JADISATU ke cPanel (Direct Git + Auto-Deploy)

Domain: **https://jadisatukreatif.com**

Sistem deployment ini menggunakan **Git murni tanpa file ZIP / TAR**, persis seperti setup project Laravel cPanel standar.

---

## 1. Konfigurasi di cPanel (Sekali Saja)

### a. Domain & Document Root
1. Buka cPanel → menu **Domains**.
2. Cari domain `jadisatukreatif.com` → pastikan **Document Root** mengarah ke:
   ```
   repositories/jadisatu/public
   ```
   *(atau `jadisatu/public` sesuai path clone repository Anda).*

### b. Database MySQL
1. Buka cPanel → **MySQL Databases**.
2. Buat database: `jadj3934_db_jadisatu-compro`
3. Buat user: `jadj3934_jadisatucreative` + password yang kuat.
4. Di bagian *Add User to Database*, hubungkan user ke database dan centang **ALL PRIVILEGES**.

### c. Versi PHP
1. Buka cPanel → **Select PHP Version** (atau **MultiPHP Manager**).
2. Pilih **PHP 8.2** atau **PHP 8.3**.
3. Pastikan ekstensi berikut aktif: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`, `zip`, `xml`, `ctype`, `bcmath`, `curl`.

### d. Clone Repository
1. Buka cPanel → **Git Version Control** → klik **Create**.
2. Masukkan URL Repository: `https://github.com/rztechdev/meraki---jadisatucompro.git`
3. Path Repository: `/home/jadj3934/repositories/jadisatu` (atau `/home/jadj3934/jadisatu`).
4. Klik **Create**.

### e. Setup `.env`
1. Lewat cPanel **File Manager**, buka folder repository di `/home/jadj3934/repositories/jadisatu/`.
2. Buat file baru bernama `.env` (atau upload `.env.production` lalu rename jadi `.env`).
3. Pastikan konfigurasi database sudah sesuai:
   ```env
   APP_NAME=JADISATU
   APP_ENV=production
   APP_KEY=base64:GK6Zf/8eEcq+osCOusZGeH5vFw/pMCdd9Wr2zBMoyn8=
   APP_DEBUG=false
   APP_URL=https://jadisatukreatif.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=jadj3934_db_jadisatu-compro
   DB_USERNAME=jadj3934_jadisatucreative
   DB_PASSWORD=password_database_anda

   SESSION_DRIVER=database
   CACHE_STORE=database
   ```

### f. Pasang Webhook Auto-Deploy (Sekali Saja)
1. Di cPanel → **Git Version Control** → klik **Manage** pada repository `jadisatu`.
2. Buka tab **Pull or Deploy**, di bagian bawah salin **Webhook / Deployment URL**.
3. Buka GitHub: `https://github.com/rztechdev/meraki---jadisatucompro/settings/hooks` → klik **Add webhook**.
4. Paste URL ke kolom **Payload URL**, pilih *Content type*: `application/json`, lalu klik **Add webhook**.

---

## 2. Alur Kerja Sehari-hari (Otomatis & Cepat)

Setiap kali ada perubahan kode atau desain:

```bash
# 1. Build asset css & js
npm run build

# 2. Push ke GitHub
git add .
git commit -m "update website"
git push origin main
```

**Selesai!** GitHub akan otomatis memicu webhook cPanel untuk pull kode terbaru, menjalankan migrasi, dan membersihkan cache dalam hitungan detik.

---

## 3. Database Seeder Awal (Dijalankan Sekali di Awal)

Untuk mengisi data awal (admin, kontak, slide, testimoni):
Buka menu **Terminal** di cPanel, lalu jalankan:

```bash
cd ~/repositories/jadisatu
php artisan db:seed --force
```

Akun login admin:
- URL: `https://jadisatukreatif.com/login`
- Email: `info@jadisatukreatif.com`
- Password: `Jadisatukreatif123*` (atau sesuai yang Anda atur di `.env`)
