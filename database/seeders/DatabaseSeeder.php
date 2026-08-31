<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HeroSlide;
use App\Models\EventGallery;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Stat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user — kredensial diambil dari .env (lihat config/admin.php)
        User::firstOrCreate(
            ['email' => config('admin.email')],
            [
                'name' => config('admin.name'),
                'password' => Hash::make(config('admin.password')),
            ]
        );

        // Hero Slides
        HeroSlide::insert([
            [
                'title' => 'Kami Menciptakan Momen yang Tak Terlupakan',
                'subtitle' => 'Event organizer profesional dengan spesialisasi di sport events dan aktivasi komunitas.',
                'image_path' => 'hero/hero-1.jpg',
                'cta_text' => 'Lihat Event Kami',
                'cta_url' => '#portfolio',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sport Events yang Menginspirasi',
                'subtitle' => 'Dari turnamen lokal hingga kompetisi besar kami hadir untuk setiap tantangan.',
                'image_path' => 'hero/hero-2.jpg',
                'cta_text' => 'Hubungi Kami',
                'cta_url' => '#contact',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Creating Stories, Crafting Moments',
                'subtitle' => 'Jadisatu hadir untuk mengubah visi Anda menjadi pengalaman nyata yang berkesan.',
                'image_path' => 'hero/hero-3.jpg',
                'cta_text' => 'Tentang Kami',
                'cta_url' => '#about',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Services
        Service::insert([
            [
                'title' => 'Sport Event Management',
                'description' => 'Pengelolaan event olahraga dari skala lokal hingga nasional. Turnamen, kompetisi, fun run, cycling, dan berbagai event sport lainnya.',
                'icon' => 'trophy',
                'color' => '#00B4D8',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Corporate Event',
                'description' => 'Team building, gathering perusahaan, outbound, dan aktivitas korporat yang dirancang untuk mempererat hubungan tim.',
                'icon' => 'building',
                'color' => '#FF6B35',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Community Activation',
                'description' => 'Aktivasi komunitas dan brand experience yang menghubungkan brand Anda dengan target market secara organik dan berkesan.',
                'icon' => 'users',
                'color' => '#4CAF50',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Festival & Exhibition',
                'description' => 'Penyelenggaraan festival, pameran, dan expo yang terorganisir dengan baik, mulai dari konsep hingga eksekusi.',
                'icon' => 'star',
                'color' => '#FFC107',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Production & Dokumentasi',
                'description' => 'Layanan produksi kreatif termasuk stage design, sound system, lighting, dokumentasi foto dan video profesional.',
                'icon' => 'camera',
                'color' => '#E91E8B',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konsultasi & Perencanaan',
                'description' => 'Layanan konsultasi event dari tahap ideasi, perencanaan, budgeting, hingga eksekusi dan evaluasi pasca event.',
                'icon' => 'clipboard',
                'color' => '#1B2B5E',
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Stats
        Stat::insert([
            ['label' => 'Event Sukses', 'value' => '150', 'suffix' => '+', 'icon' => 'trophy', 'order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Peserta Terlayani', 'value' => '50', 'suffix' => 'K+', 'icon' => 'users', 'order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Tahun Pengalaman', 'value' => '8', 'suffix' => '+', 'icon' => 'calendar', 'order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Klien Puas', 'value' => '200', 'suffix' => '+', 'icon' => 'heart', 'order' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Testimonials
        Testimonial::insert([
            [
                'name' => 'Adrian Mahendra',
                'position' => 'General Manager Operations',
                'company' => 'PT Graha Mitra Nusantara',
                'content' => 'JADISATU berhasil mengeksekusi team building kami untuk 300 karyawan dengan sempurna. Konsep yang fresh, eksekusi yang rapi, dan hasilnya luar biasa.',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Wijaya',
                'position' => 'Ketua Panitia',
                'company' => 'Fun Run Nusantara',
                'content' => 'Event fun run 5000 peserta berjalan lancar tanpa hambatan. Tim JADISATU sangat profesional, responsif, dan detail dalam setiap persiapan.',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Denny Pratama',
                'position' => 'Brand Manager',
                'company' => 'SportLife Indonesia',
                'content' => 'Kolaborasi yang sangat menyenangkan! JADISATU memahami kebutuhan brand kami dan menciptakan aktivasi yang on-point dengan target audience.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'position' => 'Event Director',
                'company' => 'Garuda Sports Festival',
                'content' => 'Koordinasi venue, flow peserta, hingga urusan teknis di lapangan dijalankan dengan sangat presisi. Sangat recommended untuk sport management!',
                'rating' => 5,
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Rahayu',
                'position' => 'HR Manager',
                'company' => 'Bank Nusantara',
                'content' => 'Family gathering perusahaan kami berjalan meriah dan penuh kehangatan. Konsep acaranya disukai oleh seluruh keluarga karyawan.',
                'rating' => 5,
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kevin Hartanto',
                'position' => 'CEO',
                'company' => 'Sportopia Indonesia',
                'content' => 'Partner yang sangat bisa diandalkan. Timeline eksekusi selalu tepat waktu dengan kualitas output di atas ekspektasi.',
                'rating' => 5,
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maya Kusuma',
                'position' => 'Brand Activation Manager',
                'company' => 'FreshUp Beverages',
                'content' => 'Aktivasi produk kami di berbagai titik event lari berlangsung sukses besar. Brand awareness meningkat drastis.',
                'rating' => 5,
                'order' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rizky Firmansyah',
                'position' => 'Ketua Komunitas',
                'company' => 'Cycling Nusantara',
                'content' => 'Gowes bareng 1000 cyclists terkelola dengan sangat aman dan nyaman. Standar keselamatan rute nomor satu!',
                'rating' => 5,
                'order' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Anggraini',
                'position' => 'Marketing Director',
                'company' => 'ActiveWear Co.',
                'content' => 'Eksekusi pameran produk olahraga kami rapi dan estetik. Tim JADISATU sangat solutif dan gesit.',
                'rating' => 5,
                'order' => 9,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Setiawan',
                'position' => 'Ketua Panitia',
                'company' => 'Jakarta Futsal Championship',
                'content' => 'Kerja sama dengan JADISATU luar biasa rapi. Manajemen turnamen futsal dari registrasi peserta, jadwal tanding, hingga live streaming berlangsung tanpa kendala.',
                'rating' => 5,
                'order' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jessica Tan',
                'position' => 'Event Specialist',
                'company' => 'Tech Indo Summit',
                'content' => 'Event gathering tahunan kami jadi berkesan banget berkat ide kreatif games dan stage setup dari tim JADISATU. Seluruh karyawan sangat antusias dan puas!',
                'rating' => 5,
                'order' => 11,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fajar Nugroho',
                'position' => 'Founder',
                'company' => 'Runners ID Community',
                'content' => 'Aktivasi komunitas 5K Sunday Run dieksekusi dengan standar keamanan dan kenyamanan peserta yang sangat tinggi. Marshall dan rute steril terorganisir.',
                'rating' => 5,
                'order' => 12,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nadia Putri',
                'position' => 'PR & Marcom Lead',
                'company' => 'Kopi Kenangan Senja',
                'content' => 'Booth activation kami di festival olahraga ramai pengunjung. Konsep interaktif yang ditawarkan JADISATU benar-benar mendatangkan engagement brand tinggi.',
                'rating' => 5,
                'order' => 13,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bayu Pratama',
                'position' => 'Tournament Lead',
                'company' => 'Esports Battle Arena',
                'content' => 'Produksi panggung, sound system, lighting, dan koneksi turnamen esport kami dikawal dengan sangat profesional. Next event pasti pakai JADISATU lagi.',
                'rating' => 5,
                'order' => 14,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clara Veronica',
                'position' => 'People & Culture',
                'company' => 'PT Sinar Abadi Kreasi',
                'content' => 'Outbound dan team building 150 staf berjalan sangat seru dan bermakna. Fasilitatornya energetik dan konsep games-nya tepat sasaran membangun kebersamaan.',
                'rating' => 5,
                'order' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Site Settings
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'JADISATU', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Website'],
            ['key' => 'tagline', 'value' => 'Creating Stories, Crafting Moments', 'type' => 'text', 'group' => 'general', 'label' => 'Tagline'],
            // About
            ['key' => 'about_title', 'value' => 'Kami adalah JADISATU', 'type' => 'text', 'group' => 'about', 'label' => 'Judul About'],
            ['key' => 'about_subtitle', 'value' => 'Event Organizer yang Mengutamakan Pengalaman', 'type' => 'text', 'group' => 'about', 'label' => 'Subtitle About'],
            ['key' => 'about_description', 'value' => 'JADISATU adalah event organizer profesional yang lahir dari passion terhadap dunia sport dan kegembiraan bersama. Kami percaya bahwa setiap event adalah kesempatan untuk menciptakan kenangan berharga, bukan sekadar acara, tapi sebuah cerita yang layak untuk diingat.\n\nBerdiri sejak 2016, kami telah menyelenggarakan ratusan event sport, corporate gathering, dan community activation di seluruh Indonesia. Dengan tim yang berpengalaman dan penuh energi, kami berkomitmen untuk memberikan pengalaman terbaik bagi klien dan peserta.', 'type' => 'textarea', 'group' => 'about', 'label' => 'Deskripsi About'],
            // Contact
            ['key' => 'contact_email', 'value' => 'info@jadisatukreatif.com', 'type' => 'text', 'group' => 'contact', 'label' => 'Email'],
            ['key' => 'contact_phone', 'value' => '0895-8023-66010 (Ayu)', 'type' => 'text', 'group' => 'contact', 'label' => 'Nomor Telepon / WhatsApp'],
            ['key' => 'contact_whatsapp', 'value' => '62895802366010', 'type' => 'text', 'group' => 'contact', 'label' => 'WhatsApp'],
            ['key' => 'contact_address', 'value' => 'Jalan Discovery Cielo III, Discovery Cielo, Pondok Aren, Banten 15227, ID', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat'],
            ['key' => 'instagram', 'value' => 'jadisatu.kreatif', 'type' => 'text', 'group' => 'contact', 'label' => 'Instagram'],
            ['key' => 'facebook', 'value' => 'jadisatu', 'type' => 'text', 'group' => 'contact', 'label' => 'Facebook'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create(array_merge($setting, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
