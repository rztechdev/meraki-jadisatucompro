# meraki---jadisatucompro

Company profile **JADISATU** — event organizer dengan fokus di sport event,
corporate gathering, dan aktivasi komunitas.

🌐 https://jadisatukreatif.com

## Stack

- Laravel 12 · PHP 8.2
- Tailwind CSS v4 · Alpine.js · Vite
- MySQL (production) / SQLite (development)

## Fitur

**Halaman publik**
- Hero slider auto-play dengan progress bar dan navigasi manual
- Dekorasi siluet olahraga (sepakbola, basket, badminton, padel, tenis, voli, lari, sepeda)
- Section: Tentang, Layanan, Portfolio dengan lightbox + filter kategori,
  Statistik, Testimoni, Tim, Keunggulan, Kontak

**Admin panel**
- Kelola hero slides, galeri event, layanan, statistik, testimoni, tim
- Pengaturan situs (teks, kontak, media sosial) tanpa sentuh kode
- Upload foto ke `storage/app/public`

## Setup lokal

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run dev
```

Akun admin dibuat dari `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di `.env`.

> `ADMIN_PASSWORD` **wajib diisi** — tidak ada nilai default. Kalau kosong,
> seeder sengaja berhenti dengan error supaya password admin yang sudah ada
> tidak tertimpa nilai lemah.
>
> `.env` adalah sumber kebenaran: mengubah `ADMIN_PASSWORD` lalu menjalankan
> `php artisan db:seed` akan ikut memperbarui password admin di database.

## Deployment

Lihat [DEPLOY.md](DEPLOY.md) untuk panduan lengkap deploy ke cPanel.

> Jalankan `npm run build` sebelum commit — folder `public/build/` ikut
> ter-commit karena shared hosting cPanel tidak menjalankan Node.js.
