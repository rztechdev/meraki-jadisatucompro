# Deployment JADISATU ke cPanel

Domain: **https://jadisatukreatif.com**

Struktur akhir di server — aplikasi diletakkan **di luar** `public_html` supaya
`.env`, `storage`, dan `vendor` tidak bisa diakses dari browser:

```
/home/USERNAME/
├── jadisatu/          ← kode Laravel + .env + storage + vendor
└── public_html/       ← document root (isi dari folder public/)
    ├── index.php      ← otomatis di-rewrite saat deploy
    ├── build/         ← hasil npm run build
    └── storage →      ← symlink ke ../jadisatu/storage/app/public
```

---

## 1. Persiapan di lokal

```bash
npm run build
```

Pastikan folder `public/build/` ikut ter-commit — shared hosting cPanel tidak
punya Node.js, jadi asset harus dibangun di lokal.

```bash
git init
git add .
git commit -m "Initial commit JADISATU"
git remote add origin <URL-REPO-ANDA>
git push -u origin main
```

---

## 2. Setup di cPanel

### a. Database MySQL

**MySQL Databases** → buat database + user, beri **ALL PRIVILEGES**.
Catat ketiga nilainya (nama DB, user, password) — akan dipakai di `.env`.

### b. Versi PHP

**Select PHP Version** → pilih **PHP 8.2** atau lebih tinggi.
Aktifkan ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`, `zip`.

### c. Domain

Pastikan `jadisatukreatif.com` document root-nya mengarah ke `public_html`.

### d. Clone repository

**Git Version Control** → *Create* → isi URL repo → path clone misalnya
`/home/USERNAME/repositories/jadisatu`.

---

## 3. Sesuaikan `.cpanel.yml`

Buka `.cpanel.yml`, ganti baris pertama dengan username cPanel Anda:

```yaml
- export CPUSER=jadisatu     # ← ganti ini
```

Commit dan push perubahannya.

---

## 4. Upload `.env` (manual, sekali saja)

File `.env` **tidak pernah** ikut git. Upload manual lewat File Manager:

1. Buat folder `/home/USERNAME/jadisatu/`
2. Upload `.env.production` ke situ
3. **Rename** menjadi `.env`
4. Edit dan isi 3 baris database:

```env
DB_DATABASE=USERNAME_namadb
DB_USERNAME=USERNAME_userdb
DB_PASSWORD=password-anda
```

5. Isi juga password admin — **jangan biarkan nilai default**:

```env
ADMIN_EMAIL=info@jadisatukreatif.com
ADMIN_PASSWORD=password-kuat-anda
```

`APP_KEY` sudah terisi — jangan diganti setelah ada data di database.

---

## 5. Deploy pertama

Di **Git Version Control** → tab *Pull or Deploy* → klik **Deploy HEAD Commit**.

Setelah selesai, jalankan seeder **sekali saja** lewat Terminal cPanel:

```bash
cd ~/jadisatu && php artisan db:seed --force
```

Ini mengisi data awal: user admin, hero slides, layanan, statistik, testimoni,
dan pengaturan situs.

Akun admin dibuat dari `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di `.env` —
login di `https://jadisatukreatif.com/login`.

---

## 6. Aktifkan SSL

**SSL/TLS Status** → *Run AutoSSL* untuk `jadisatukreatif.com`.
Redirect HTTPS dan non-www sudah diatur di `public/.htaccess`.

---

## Deploy berikutnya

Cukup tiga langkah:

```bash
npm run build
git add . && git commit -m "update"
git push
```

Lalu klik **Deploy HEAD Commit** di cPanel.

Yang **tidak pernah** tertimpa saat deploy:
- `.env` — kredensial server
- `storage/` — foto event yang di-upload lewat admin panel

---

## Troubleshooting

| Gejala | Penyebab & solusi |
|---|---|
| Halaman blank / HTTP 500 | Cek `~/jadisatu/storage/logs/laravel.log`. Biasanya `.env` belum diisi atau permission `storage` salah — jalankan `chmod -R 775 ~/jadisatu/storage` |
| CSS/JS tidak muncul | `public/build/` belum ter-commit. Jalankan `npm run build` lalu commit ulang |
| Foto event tidak tampil | Symlink putus. Jalankan: `ln -sfn ~/jadisatu/storage/app/public ~/public_html/storage` |
| Perubahan kode tidak berefek | Cache lama. Jalankan: `cd ~/jadisatu && php artisan optimize:clear` |
| `composer: not found` saat deploy | Path composer berbeda. Cek dengan `which composer`, lalu sesuaikan `COMPOSER=` di `.cpanel.yml` |
| Error koneksi database | Pastikan user DB sudah diberi **ALL PRIVILEGES** di cPanel MySQL Databases |
