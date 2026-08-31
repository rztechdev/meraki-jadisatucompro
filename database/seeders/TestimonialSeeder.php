<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Ahmad Fauzi', 'position' => 'Event Director', 'company' => 'Garuda Sports Festival', 'content' => 'Tim JADISATU luar biasa! Mereka berhasil mengelola marathon 10.000 peserta dengan sangat rapi. Dari rute, checkpoint, hingga finisher medal — semua tereksekusi sempurna. Akan kami ajak kerja sama lagi tahun depan.', 'rating' => 5, 'order' => 4],
            ['name' => 'Siti Rahayu', 'position' => 'HR Manager', 'company' => 'Bank Nusantara', 'content' => 'Kami mempercayakan team building tahunan 500 karyawan kepada JADISATU. Konsep yang mereka bawa fresh, tidak pasaran. Karyawan kami benar-benar antusias dan masih membicarakannya sampai sekarang.', 'rating' => 5, 'order' => 5],
            ['name' => 'Kevin Hartanto', 'position' => 'CEO', 'company' => 'Sportopia Indonesia', 'content' => 'Profesionalisme JADISATU tidak perlu diragukan. Deadlines selalu on-time, koordinasi lancar, dan mereka proaktif memberikan solusi ketika ada kendala. Partner event terbaik yang pernah kami miliki.', 'rating' => 5, 'order' => 6],
            ['name' => 'Maya Kusuma', 'position' => 'Brand Activation Manager', 'company' => 'FreshUp Beverages', 'content' => 'Aktivasi brand kami di 5 kota berjalan mulus berkat JADISATU. Mereka punya jaringan yang luas dan memahami dinamika setiap kota. ROI event kami meningkat signifikan dibanding tahun sebelumnya.', 'rating' => 5, 'order' => 7],
            ['name' => 'Rizky Firmansyah', 'position' => 'Ketua Komunitas', 'company' => 'Cycling Nusantara', 'content' => 'Sudah dua kali kami menggunakan JADISATU untuk bike festival kami. Mereka benar-benar mengerti culture komunitas bersepeda. Tidak hanya sekedar organizer, tapi mitra yang ikut passionate dengan visi kami.', 'rating' => 5, 'order' => 8],
            ['name' => 'Dewi Anggraini', 'position' => 'Marketing Director', 'company' => 'ActiveWear Co.', 'content' => 'Exhibition produk kami di 3 mall sekaligus berhasil menarik 15.000 pengunjung — jauh melampaui target. JADISATU tahu cara menciptakan experience yang memorable dan mengkonversi pengunjung menjadi pembeli.', 'rating' => 5, 'order' => 9],
        ];

        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['name' => $t['name'], 'company' => $t['company']], array_merge($t, ['is_active' => true]));
        }
    }
}
