<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Akun Admin Awal
    |--------------------------------------------------------------------------
    |
    | Dipakai oleh DatabaseSeeder untuk membuat user admin pertama.
    | Nilainya diambil dari .env supaya kredensial tidak tertulis di kode
    | dan bisa berbeda antara lokal dan production.
    |
    | Sengaja TANPA nilai default untuk password: kalau ADMIN_PASSWORD
    | lupa diisi, seeder harus berhenti dengan error — bukan diam-diam
    | memakai password lemah.
    |
    */

    'name'     => env('ADMIN_NAME', 'Admin JADISATU'),
    'email'    => env('ADMIN_EMAIL', 'info@jadisatukreatif.com'),
    'password' => env('ADMIN_PASSWORD'),

];
