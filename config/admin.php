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
    */

    'name'     => env('ADMIN_NAME', 'Admin JADISATU'),
    'email'    => env('ADMIN_EMAIL', 'info@jadisatukreatif.com'),
    'password' => env('ADMIN_PASSWORD', 'password'),

];
