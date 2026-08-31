@extends('layouts.app')

@section('title', 'JADISATU — Creating Stories, Crafting Moments')

@push('styles')
<style>
    html { scroll-behavior: smooth; }

    /* Nav */
    #navbar { transition: background 0.4s, box-shadow 0.4s; }
    #navbar.scrolled { background: rgba(27,43,94,0.97); box-shadow: 0 4px 24px rgba(0,0,0,0.18); }

    .nav-link {
        position: relative;
        padding-bottom: 2px;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #1B2B5E;
        transition: width 0.25s ease;
        border-radius: 2px;
    }
    .nav-link:hover::after { width: 100%; }

    /* Hero Slider */
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1.2s ease; }
    .hero-slide.active { opacity: 1; }
    .hero-slide img { width: 100%; height: 100%; object-fit: cover; }

    /* Progress bar */
    .slide-progress { animation: progress linear; }
    @keyframes progress { from { width: 0%; } to { width: 100%; } }

    /* Gallery hover */
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-item:hover img { transform: scale(1.05); }
    .gallery-item img { transition: transform 0.6s ease; }

    /* Service card */
    .service-card {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    border-color 0.3s ease;
        will-change: transform, box-shadow;
        box-shadow: 0 4px 15px -3px rgba(27, 43, 94, 0.05);
    }
    .service-card:hover {
        transform: translateY(-6px) scale(1.035) !important;
        border-color: #FF6B35 !important;
        box-shadow: 0 20px 40px -10px rgba(27, 43, 94, 0.12),
                    0 0 0 1px #FF6B35 !important;
    }

    /* Testimonial slider */
    .testi-track { transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); }

    /* Fade in animation */
    .fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.65s ease, transform 0.65s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* Sport silhouette float animations */
    @keyframes floatSport  { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-16px); } }
    @keyframes floatSport2 { 0%,100% { transform: translateY(-10px); } 50% { transform: translateY(10px); } }
    @keyframes floatSport3 { 0%,100% { transform: translateY(0) rotate(-.6deg); } 50% { transform: translateY(-12px) rotate(.6deg); } }
    @keyframes floatSport4 { 0%,100% { transform: translateY(-5px) rotate(-1deg); } 33% { transform: translateY(-14px) rotate(.4deg); } 66% { transform: translateY(4px); } }
    .sport-float  { animation: floatSport  7s ease-in-out infinite; }
    .sport-float2 { animation: floatSport2 9s ease-in-out infinite; }
    .sport-float3 { animation: floatSport3 8s ease-in-out infinite; }
    .sport-float4 { animation: floatSport4 10s ease-in-out infinite; }

    /* Marquee Tickers */
    @keyframes marquee-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    @keyframes marquee-right {
        0% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }
    .animate-marquee-left {
        display: flex;
        width: max-content;
        animation: marquee-left 35s linear infinite;
        will-change: transform;
    }
    .animate-marquee-right {
        display: flex;
        width: max-content;
        animation: marquee-right 40s linear infinite;
        will-change: transform;
    }
    .marquee-container:hover .animate-marquee-left,
    .marquee-container:hover .animate-marquee-right {
        animation-play-state: paused;
    }
</style>
@endpush

@section('content')

{{-- NAVBAR --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="#" class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-8 w-8 object-contain rounded-lg overflow-hidden shadow-sm">
                <span class="text-white font-extrabold text-lg tracking-wide">JADISATU</span>
            </a>

            <div class="hidden md:flex items-center gap-7">
                <a href="#about"     class="nav-link text-white/80 hover:text-white text-[13px] font-medium tracking-wide transition-colors">Tentang Kami</a>
                <a href="#services"  class="nav-link text-white/80 hover:text-white text-[13px] font-medium tracking-wide transition-colors">Layanan</a>
                <a href="#portfolio" class="nav-link text-white/80 hover:text-white text-[13px] font-medium tracking-wide transition-colors">Portfolio</a>
                @php $wa = \App\Models\SiteSetting::get('contact_whatsapp', '62895802366010'); @endphp
                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo JADISATU (Ayu), saya ingin konsultasi event.') }}" target="_blank"
                   class="bg-[#FF6B35] hover:bg-[#e85a26] text-white text-xs font-bold px-5 py-2 rounded-xl transition-all hover:shadow-lg hover:shadow-orange-500/25 ml-2">
                    Hubungi Kami
                </a>
            </div>

            {{-- Hamburger Button --}}
            <button @click="mobileMenuOpen = true" class="md:hidden text-white p-1.5 rounded-lg bg-white/10 hover:bg-white/20 transition-colors focus:outline-none" aria-label="Buka Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Fullscreen Menu (Slide Up dari Bawah dengan Background Putih Bersih) --}}
    <div x-show="mobileMenuOpen"
         class="fixed inset-0 z-50 md:hidden"
         style="display: none;"
         @keydown.escape.window="mobileMenuOpen = false">
        
        {{-- Fullscreen Sheet (Slide Up dari Bawah - Warna Biru Header #1B2B5E) --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition-all duration-[950ms] ease-[cubic-bezier(0.16,1,0.3,1)]"
             x-transition:enter-start="translate-y-full opacity-70"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition-all duration-[650ms] ease-[cubic-bezier(0.7,0,0.84,0)]"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-70"
             class="fixed inset-0 z-50 bg-[#1B2B5E] flex flex-col justify-between p-6 sm:p-8 overflow-y-auto">
            
            <div>
                {{-- Header with Brand & Close Button --}}
                <div class="flex items-center justify-between pb-5 mb-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-9 w-9 object-contain rounded-xl overflow-hidden shadow-sm">
                        <div>
                            <span class="text-white font-black text-lg tracking-wide block leading-tight">JADISATU</span>
                            <span class="text-white/45 text-xs">Event Organizer</span>
                        </div>
                    </div>
                    <button @click="mobileMenuOpen = false"
                            class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 text-white/80 hover:text-white flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Navigation Links --}}
                <nav class="space-y-1.5">
                    <a href="#about" @click="mobileMenuOpen = false"
                       class="flex items-center justify-between px-4 py-3.5 rounded-2xl text-white/85 hover:text-white hover:bg-white/8 text-base font-bold transition-all border border-transparent hover:border-white/10">
                        <span>Tentang Kami</span>
                        <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#services" @click="mobileMenuOpen = false"
                       class="flex items-center justify-between px-4 py-3.5 rounded-2xl text-white/85 hover:text-white hover:bg-white/8 text-base font-bold transition-all border border-transparent hover:border-white/10">
                        <span>Layanan</span>
                        <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="#portfolio" @click="mobileMenuOpen = false"
                       class="flex items-center justify-between px-4 py-3.5 rounded-2xl text-white/85 hover:text-white hover:bg-white/8 text-base font-bold transition-all border border-transparent hover:border-white/10">
                        <span>Portfolio & Dokumentasi</span>
                        <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </nav>
            </div>

            {{-- Footer Action & Contact inside Fullscreen Menu --}}
            <div class="mt-8 pt-5 border-t border-white/10 space-y-3">
                @php $wa = \App\Models\SiteSetting::get('contact_whatsapp', '62895802366010'); @endphp
                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo JADISATU (Ayu), saya ingin konsultasi event.') }}" target="_blank"
                   class="w-full bg-[#FF6B35] hover:bg-[#e85a26] text-white font-bold py-4 px-6 rounded-2xl flex items-center justify-center gap-2.5 transition-all text-sm active:scale-98">
                    <span>Hubungi Kami</span>
                </a>
                <div class="text-center text-xs text-white/40">
                    <span>info@jadisatukreatif.com</span> • <span>0895-8023-66010 (Ayu)</span>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- HERO SLIDER --}}
<section class="relative h-screen min-h-[600px] overflow-hidden bg-[#1B2B5E]" x-data="heroSlider()" x-init="init()">
    @if($heroSlides->count() > 0)
        @foreach($heroSlides as $i => $slide)
            <div class="hero-slide" :class="{ active: current === {{ $i }} }">
                @if(Storage::disk('public')->exists($slide->image_path))
                    <img src="{{ asset('storage/'.$slide->image_path) }}" alt="{{ $slide->title }}" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#1B2B5E] via-[#2a4080] to-[#0d1a3a]"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-[#1B2B5E]/85 via-[#1B2B5E]/45 to-transparent"></div>
            </div>
        @endforeach
    @else
        <div class="hero-slide active">
            <div class="w-full h-full bg-gradient-to-br from-[#1B2B5E] via-[#243d7a] to-[#0d1a3a]"></div>
        </div>
    @endif

    {{-- SPORT SILHOUETTES — bayangan putih dekoratif --}}
    <div class="absolute inset-0 z-[5] pointer-events-none select-none overflow-hidden text-white"
         aria-hidden="true">

        {{-- ══ STRUKTUR LAPANGAN ══ --}}

        {{-- Net badminton (backdrop kiri atas) --}}
        <div class="hidden lg:block absolute top-[4%] left-0 w-[330px] xl:w-[420px] opacity-[0.045] sport-float2">
            <svg viewBox="0 0 160 100" class="w-full h-auto" fill="none" stroke="currentColor" stroke-linecap="round">
                <path d="M4 88 L156 88" stroke-width="3"/>
                <path d="M16 88 L16 26 M144 88 L144 26" stroke-width="4.5"/>
                <path d="M16 26 Q80 42 144 26" stroke-width="4"/>
                <path d="M16 32 Q80 48 144 32" stroke-width="2"/>
                <g stroke-width="1.4">
                    <path d="M29 29 L29 72"/><path d="M42 31 L42 75"/><path d="M55 33 L55 77"/>
                    <path d="M68 34 L68 78"/><path d="M81 34 L81 78"/><path d="M94 34 L94 78"/>
                    <path d="M107 32 L107 76"/><path d="M120 31 L120 75"/><path d="M133 28 L133 72"/>
                    <path d="M16 40 Q80 56 144 40"/><path d="M16 52 Q80 68 144 52"/><path d="M16 64 Q80 80 144 64"/>
                </g>
                <path d="M16 70 Q80 86 144 70" stroke-width="2.5"/>
            </svg>
        </div>

        {{-- Gawang sepakbola (backdrop kanan bawah) --}}
        <div class="absolute bottom-[2%] right-0 w-[330px] md:w-[420px] xl:w-[520px] opacity-[0.05] sport-float">
            <svg viewBox="0 0 160 100" class="w-full h-auto" fill="none" stroke="currentColor" stroke-linecap="round">
                <g stroke-width="1.5">
                    <path d="M29 22 L29 84"/><path d="M42 22 L42 84"/><path d="M55 22 L55 84"/>
                    <path d="M68 22 L68 84"/><path d="M81 22 L81 84"/><path d="M94 22 L94 84"/>
                    <path d="M107 22 L107 84"/><path d="M120 22 L120 84"/><path d="M133 22 L133 84"/>
                    <path d="M16 32 L144 32"/><path d="M16 42 L144 42"/><path d="M16 52 L144 52"/>
                    <path d="M16 62 L144 62"/><path d="M16 72 L144 72"/><path d="M16 82 L144 82"/>
                </g>
                <path d="M16 84 L16 22 L144 22 L144 84" stroke-width="5"/>
                <path d="M2 84 L158 84" stroke-width="3"/>
            </svg>
        </div>

        {{-- Ring basket (kanan atas) --}}
        <div class="absolute top-[3%] right-[2%] w-24 h-24 sm:w-36 sm:h-36 lg:w-56 lg:h-56 opacity-[0.06] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 8 L80 8 L80 50 L20 50 Z" stroke-width="4.5"/>
                <path d="M37 25 L63 25 L63 44 L37 44 Z" stroke-width="4"/>
                <ellipse cx="50" cy="54" rx="16" ry="4.5" stroke-width="4.5"/>
                <g stroke-width="2.4">
                    <path d="M35 56 Q38 70 45 80 M42 57 Q43 70 47 81 M50 58 L50 82 M58 57 Q57 70 53 81 M65 56 Q62 70 55 80"/>
                    <path d="M38 64 Q50 69 62 64 M42 72 Q50 77 58 72 M45 79 Q50 83 55 79"/>
                </g>
            </svg>
        </div>

        {{-- ══ FIGUR ATLET ══ --}}

        {{-- Badminton — smash (kiri atas, di depan net) --}}
        <div class="absolute top-[8%] left-[2%] md:top-[5%] md:left-[12%] w-28 h-28 md:w-40 md:h-40 lg:w-56 lg:h-56 opacity-[0.085] sport-float">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="43" cy="24" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M43 33 L41 57"/>
                <path d="M43 37 L57 21"/>
                <ellipse cx="65" cy="12" rx="8" ry="10.5" transform="rotate(-38 65 12)" stroke-width="4.5"/>
                <path d="M43 41 L27 47"/>
                <path d="M41 57 L29 77 L25 91"/>
                <path d="M41 57 L57 75 L66 87"/>
                <path d="M86 5 L82 13 M86 5 L90 13 M86 5 L86 14" stroke-width="4"/>
                <circle cx="86" cy="4" r="2.5" fill="currentColor" stroke="none"/>
            </svg>
        </div>

        {{-- Basket — dunk (kanan atas, ke arah ring) --}}
        <div class="absolute top-[12%] right-[10%] md:right-[13%] w-36 h-36 md:w-48 md:h-48 lg:w-64 lg:h-64 opacity-[0.085] sport-float2">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="48" cy="26" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M48 35 L46 60"/>
                <path d="M48 39 L34 24 L29 13"/>
                <path d="M48 41 L64 26 L69 15"/>
                <path d="M46 60 L35 80 L31 93"/>
                <path d="M46 60 L60 79 L64 92"/>
                <circle cx="50" cy="8" r="8.5" stroke-width="4.5"/>
            </svg>
        </div>

        {{-- Tenis — forehand (kanan tengah) --}}
        <div class="hidden sm:block absolute top-[40%] right-[2%] w-40 h-40 lg:w-60 lg:h-60 opacity-[0.075] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="40" cy="24" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M40 33 L43 58"/>
                <path d="M40 38 L60 43"/>
                <ellipse cx="74" cy="45" rx="9" ry="11.5" transform="rotate(72 74 45)" stroke-width="4.5"/>
                <path d="M40 36 L24 31"/>
                <path d="M43 58 L31 78 L26 91"/>
                <path d="M43 58 L60 79 L69 88"/>
                <circle cx="16" cy="18" r="5" stroke-width="4"/>
            </svg>
        </div>

        {{-- Voli — spike (kanan tengah-bawah) --}}
        <div class="hidden xl:block absolute top-[60%] right-[30%] w-48 h-48 opacity-[0.06] sport-float4">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="46" cy="28" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M46 37 L45 61"/>
                <path d="M46 41 L60 25 L64 13"/>
                <path d="M46 44 L30 36"/>
                <path d="M45 61 L34 81 L30 93"/>
                <path d="M45 61 L59 80 L63 92"/>
                <circle cx="70" cy="7" r="7" stroke-width="4"/>
            </svg>
        </div>

        {{-- Sepakbola — tendangan ke arah gawang (kanan bawah) --}}
        <div class="absolute bottom-[13%] right-[26%] md:right-[27%] w-36 h-36 md:w-48 md:h-48 lg:w-64 lg:h-64 opacity-[0.085] sport-float4">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="44" cy="20" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M44 29 L41 54"/>
                <path d="M44 34 L26 28"/>
                <path d="M44 36 L62 45"/>
                <path d="M41 54 L36 76 L38 91"/>
                <path d="M41 54 L62 62 L78 55"/>
                <circle cx="89" cy="52" r="8" stroke-width="4.5"/>
            </svg>
        </div>

        {{-- Lari — sprint (bawah tengah) --}}
        <div class="absolute bottom-[2%] left-[2%] lg:bottom-[2%] lg:left-[26%] w-28 h-28 lg:w-48 lg:h-48 xl:w-56 xl:h-56 opacity-[0.07] sport-float2">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="56" cy="19" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M56 28 L48 53"/>
                <path d="M54 34 L37 26 L33 15"/>
                <path d="M53 38 L70 47 L76 40"/>
                <path d="M48 53 L62 68 L58 87"/>
                <path d="M48 53 L33 65 L38 84"/>
            </svg>
        </div>

        {{-- Sepeda (kiri bawah) --}}
        <div class="hidden lg:block absolute bottom-[4%] left-[1%] w-48 h-48 xl:w-64 xl:h-64 opacity-[0.06] sport-float">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="21" cy="76" r="16"/>
                <circle cx="79" cy="76" r="16"/>
                <path d="M21 76 L44 76 L58 52 L79 76 M44 76 L58 52 M58 52 L70 52"/>
                <path d="M70 52 L76 44"/>
                <circle cx="63" cy="24" r="7" fill="currentColor" stroke="none"/>
                <path d="M60 31 L46 46 L58 52" stroke-width="5.5"/>
                <path d="M56 34 L74 44" stroke-width="5.5"/>
                <path d="M46 46 L38 62" stroke-width="5.5"/>
            </svg>
        </div>

        {{-- ══ AKSEN PERALATAN ══ --}}

        {{-- Raket padel (kiri tengah) --}}
        <div class="hidden lg:block absolute top-[13%] left-[34%] w-24 h-24 xl:w-28 xl:h-28 opacity-[0.05] sport-float4">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="5.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M50 8 C29 8 16 25 16 43 C16 58 27 68 50 68 C73 68 84 58 84 43 C84 25 71 8 50 8 Z"/>
                <path d="M44 68 L44 88 M56 68 L56 88 M44 88 Q50 96 56 88" stroke-width="5"/>
                <circle cx="36" cy="30" r="3" fill="currentColor" stroke="none"/>
                <circle cx="50" cy="26" r="3" fill="currentColor" stroke="none"/>
                <circle cx="64" cy="30" r="3" fill="currentColor" stroke="none"/>
                <circle cx="36" cy="46" r="3" fill="currentColor" stroke="none"/>
                <circle cx="50" cy="42" r="3" fill="currentColor" stroke="none"/>
                <circle cx="64" cy="46" r="3" fill="currentColor" stroke="none"/>
            </svg>
        </div>

        {{-- Bola sepak (atas tengah) --}}
        <div class="absolute top-[6%] left-[42%] lg:top-[9%] w-12 h-12 lg:w-24 lg:h-24 xl:w-28 xl:h-28 opacity-[0.05] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4.5" stroke-linejoin="round">
                <circle cx="50" cy="50" r="30"/>
                <path d="M50 36 L63.3 45.7 L58.2 61.3 L41.8 61.3 L36.7 45.7 Z" fill="currentColor" stroke="none"/>
                <path d="M50 36 L50 20 M63.3 45.7 L77.6 41.1 M58.2 61.3 L67 73.4 M41.8 61.3 L33 73.4 M36.7 45.7 L22.4 41.1"/>
            </svg>
        </div>

        {{-- Bola basket (bawah tengah) --}}
        <div class="absolute top-[26%] left-[8%] lg:top-auto lg:left-auto lg:bottom-[10%] lg:right-[47%] w-12 h-12 lg:w-20 lg:h-20 xl:w-24 xl:h-24 opacity-[0.045] sport-float2">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4.5">
                <circle cx="50" cy="50" r="30"/>
                <path d="M50 20 L50 80 M20 50 L80 50"/>
                <path d="M22 32 Q50 50 22 68 M78 32 Q50 50 78 68"/>
            </svg>
        </div>
    </div>

    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
            @if($heroSlides->count() > 0)
                @foreach($heroSlides as $i => $slide)
                    <div x-show="current === {{ $i }}"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="max-w-3xl">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-6">
                            {!! nl2br(e($slide->title)) !!}
                        </h1>
                        @if($slide->subtitle)
                            <p class="text-white/65 text-lg md:text-xl mb-10 max-w-2xl leading-relaxed font-light">{{ $slide->subtitle }}</p>
                        @endif
                        <div class="flex flex-wrap gap-4">
                            @if($slide->cta_text)
                                <a href="{{ $slide->cta_url ?? '#contact' }}"
                                   class="inline-flex items-center gap-2 bg-[#FF6B35] hover:bg-[#e85a26] text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-2xl hover:shadow-orange-500/30 hover:-translate-y-0.5 text-sm">
                                    {{ $slide->cta_text }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            @endif
                            <a href="#portfolio"
                               class="inline-flex items-center gap-2 border border-white/25 hover:border-white/60 text-white font-semibold px-8 py-4 rounded-xl transition-all hover:-translate-y-0.5 text-sm backdrop-blur-sm">
                                Lihat Portfolio
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="max-w-3xl">
                    <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6">Kami Menciptakan<br>Momen Tak Terlupakan</h1>
                    <p class="text-white/65 text-xl mb-10 font-light">Sport events, corporate gathering, dan aktivasi komunitas yang berkesan.</p>
                    <a href="#contact" class="inline-flex items-center gap-2 bg-[#FF6B35] text-white font-bold px-8 py-4 rounded-xl text-sm">
                        Hubungi Kami
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if($heroSlides->count() > 1)
        <div class="absolute bottom-8 left-0 right-0 z-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center gap-6">
                <div class="flex gap-2">
                    @foreach($heroSlides as $i => $slide)
                        <button @click="goTo({{ $i }})"
                                class="relative h-1 overflow-hidden rounded-full transition-all duration-300"
                                :class="current === {{ $i }} ? 'w-12 bg-white/20' : 'w-4 bg-white/20 hover:bg-white/40'">
                            <div x-show="current === {{ $i }}"
                                 class="absolute inset-y-0 left-0 bg-white rounded-full transition-[width] duration-75 ease-linear"
                                 :style="'width: ' + (current === {{ $i }} ? progress : 0) + '%'"></div>
                        </button>
                    @endforeach
                </div>
                <div class="ml-auto flex gap-2">
                    <button @click="prev()" class="w-9 h-9 rounded-xl border border-white/20 hover:border-white/50 flex items-center justify-center text-white/60 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" class="w-9 h-9 rounded-xl border border-white/20 hover:border-white/50 flex items-center justify-center text-white/60 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ABOUT --}}
<section id="about" class="py-24 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            <div class="fade-up">
                <h2 class="text-3xl lg:text-4xl font-black text-[#1B2B5E] leading-tight mb-5">
                    {{ \App\Models\SiteSetting::get('about_title', 'Kami adalah JADISATU') }}
                </h2>
                <p class="text-[#FF6B35] text-sm font-semibold mb-6">
                    {{ \App\Models\SiteSetting::get('about_subtitle', 'Event Organizer yang Mengutamakan Pengalaman') }}
                </p>
                <div class="text-gray-500 leading-relaxed space-y-4 text-[15px]">
                    @php
                        $desc = \App\Models\SiteSetting::get('about_description', '');
                        $paragraphs = array_filter(preg_split('/\r\n|\r|\n/', $desc));
                    @endphp
                    @foreach($paragraphs as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
                <div class="mt-10">
                    <a href="#portfolio" class="inline-flex items-center gap-2 bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-bold px-7 py-3.5 rounded-xl transition-all text-sm">
                        Lihat Portfolio
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            <div class="fade-up" style="transition-delay: 0.15s">
                @php
                    $values = [
                        [
                            'num' => '01',
                            'title' => 'Konsep Segar & Kreatif',
                            'desc' => 'Ide acara inovatif dan relevan dengan tren audiens masa kini untuk menciptakan dampak visual dan emosional maksimal.',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Eksekusi Presisi & Disiplin',
                            'desc' => 'Manajemen teknis panggung, koordinasi vendor, dan alur rundown yang dijalankan dengan standar keselamatan dan ketepatan tinggi.',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Dedikasi Tim Inti',
                            'desc' => 'Pendekatan boutique di mana setiap event diprioritaskan dan dikawal langsung oleh tim inti berpengalaman.',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Transparan & Terukur',
                            'desc' => 'Alokasi anggaran yang jelas, efisien, dan transparan tanpa ada biaya tersembunyi dengan laporan evaluasi terstruktur.',
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:gap-5">
                    @foreach($values as $val)
                        <div class="group bg-[#fcfdfe] hover:bg-white rounded-2xl p-3.5 sm:p-5 lg:p-6 border border-gray-100/90 shadow-sm hover:shadow-xl hover:border-[#FF6B35]/40 transition-all duration-300 ease-out hover:-translate-y-1 flex flex-col justify-between cursor-default">
                            <div>
                                <div class="flex items-center justify-between mb-2.5 sm:mb-3">
                                    <span class="text-[10px] sm:text-xs font-black px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg bg-gray-100 text-gray-500 group-hover:bg-[#1B2B5E] group-hover:text-white transition-colors duration-300">
                                        {{ $val['num'] }}
                                    </span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200 group-hover:bg-[#FF6B35] transition-colors duration-300"></span>
                                </div>
                                <h4 class="text-xs sm:text-base font-bold text-[#1B2B5E] group-hover:text-[#FF6B35] transition-colors duration-300 mb-1 leading-snug">
                                    {{ $val['title'] }}
                                </h4>
                                <p class="text-gray-400 text-[11px] sm:text-xs lg:text-[13px] leading-relaxed">
                                    {{ $val['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section id="services" class="py-24 lg:py-32 bg-[#f7f8fc]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="mb-14 fade-up text-center">
            <h2 class="text-3xl lg:text-4xl font-black text-[#1B2B5E]">Apa yang Kami Lakukan</h2>
            <p class="text-gray-400 mt-3 text-[14px]">Dari perencanaan hingga eksekusi, solusi event yang komprehensif dan berkesan.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 md:gap-6 service-card-wrapper">
            @foreach($services as $i => $service)
                <div class="fade-up h-full" style="transition-delay: {{ $i * 0.08 }}s">
                    <div class="service-card bg-white rounded-2xl p-3.5 sm:p-6 md:p-8 border-2 border-gray-100/90 cursor-default h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl bg-[#1B2B5E]/6 flex items-center justify-center">
                                    @include('components.public.icon', ['name' => $service->icon, 'color' => '#1B2B5E'])
                                </div>
                                <span class="text-[10px] sm:text-xs font-black px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg bg-gray-100 text-gray-400">
                                    {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <h3 class="text-xs sm:text-base md:text-lg font-bold text-[#1B2B5E] mb-1 sm:mb-2 tracking-tight leading-snug">{{ $service->title }}</h3>
                            <p class="text-gray-400 leading-relaxed text-[11px] sm:text-xs md:text-sm">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PORTFOLIO / GALLERY SHOWCASE --}}
<section id="portfolio" class="py-24 lg:py-32 bg-slate-50/70 relative overflow-hidden" x-data="gallery()" x-init="init()">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 fade-up">
            <div>
                <h2 class="text-3xl lg:text-4xl font-black text-[#1B2B5E] tracking-tight">Event yang Pernah Kami Kelola</h2>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-[#1B2B5E]/5 text-[#1B2B5E] text-xs font-bold uppercase tracking-wider mt-3 mb-2.5">
                    <span class="w-2 h-2 rounded-full bg-[#FF6B35]"></span>
                    Portfolio & Dokumentasi
                </div>
                <p class="text-gray-400 max-w-xl text-sm leading-relaxed">Setiap event adalah cerita. Berikut dokumentasi momen-momen spektakuler yang telah kami ciptakan bersama.</p>
            </div>

            @php $categories = $galleries->pluck('category')->unique()->filter()->values(); @endphp
            <div class="flex items-center gap-4 flex-wrap">
                @if($categories->count() > 1)
                    <div class="flex flex-wrap gap-1.5 bg-gray-200/60 p-1 rounded-xl">
                        <button @click="filter = 'all'"
                                :class="filter === 'all' ? 'bg-[#1B2B5E] text-white shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                                class="px-4 py-2 rounded-lg text-xs font-bold transition-all">Semua</button>
                        @foreach($categories as $cat)
                            <button @click="filter = '{{ $cat }}'"
                                    :class="filter === '{{ $cat }}' ? 'bg-[#1B2B5E] text-white shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                                    class="px-4 py-2 rounded-lg text-xs font-bold transition-all capitalize">{{ ucfirst($cat) }}</button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if($galleries->count() > 0)
            <div class="fade-up">
                {{-- Main Big Slide Showcase --}}
                <div class="relative w-full h-[400px] sm:h-[480px] md:h-[540px] lg:h-[580px] rounded-2xl overflow-hidden bg-[#0d1a3a] shadow-2xl shadow-[#1B2B5E]/15 group cursor-pointer"
                     @mouseenter="isPaused = true" @mouseleave="isPaused = false">
                    
                    <template x-for="(item, idx) in filteredItems" :key="item.id">
                        <div class="absolute inset-0 transition-opacity duration-700 ease-in-out overflow-hidden"
                             :class="current === idx ? 'opacity-100 z-10 pointer-events-auto' : 'opacity-0 z-0 pointer-events-none'">
                            
                            {{-- Layer 1: Ambient Blurred Backdrop (Sisi samping blur otomatis bila foto portrait) --}}
                            <img :src="item.image_url" :alt="item.title"
                                 class="absolute inset-0 w-full h-full object-cover filter blur-3xl scale-125 opacity-40 brightness-75 pointer-events-none select-none">
                            
                            {{-- Layer 2: Foreground Sharp Photo (Tampil proporsional & utuh) --}}
                            <div class="relative z-10 w-full h-full flex items-center justify-center">
                                <img :src="item.image_url" :alt="item.title"
                                     class="w-full h-full object-cover sm:object-contain select-none transition-transform duration-1000 ease-out"
                                     :class="current === idx ? 'scale-100' : 'scale-105'"
                                     @click="openLightbox(item.image_url, item.title, item.location)">
                            </div>
                            
                            {{-- Cinematic Gradient Overlays --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b142b]/95 via-[#0b142b]/25 to-transparent pointer-events-none z-10"></div>
                            <div class="absolute inset-x-0 top-0 h-28 bg-gradient-to-b from-black/40 to-transparent pointer-events-none z-10"></div>

                            {{-- Top Badges & Controls --}}
                            <div class="absolute top-6 left-6 right-6 flex items-center justify-between z-20 pointer-events-none">
                                <div class="flex items-center gap-2 pointer-events-auto transition-all duration-500 delay-75"
                                     :class="current === idx ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-2'">
                                    <span class="px-3.5 py-1.5 rounded-lg bg-[#FF6B35] text-white text-xs font-semibold uppercase tracking-wider shadow-md"
                                          x-text="item.category"></span>
                                    <span x-show="item.is_featured"
                                          class="px-3.5 py-1.5 rounded-lg bg-amber-400 text-[#1B2B5E] text-xs font-bold flex items-center gap-1 shadow-md">
                                        ★ FEATURED
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 pointer-events-auto">
                                    <button @click.stop="openLightbox(item.image_url, item.title, item.location)"
                                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-black/40 hover:bg-black/70 backdrop-blur-md text-white text-xs font-medium transition-all hover:scale-105 shadow-lg border border-white/10">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                        <span class="hidden sm:inline">Perbesar Foto</span>
                                    </button>
                                </div>
                            </div>

                            {{-- Bottom Info Content --}}
                            <div class="absolute bottom-6 left-6 right-6 sm:bottom-10 sm:left-10 sm:right-10 z-20 pointer-events-none transition-all duration-700 delay-75"
                                 :class="current === idx ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">
                                <div class="max-w-3xl">
                                    <div class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-medium mb-1.5" x-show="item.location">
                                        <svg class="w-4 h-4 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span x-text="item.location"></span>
                                    </div>
                                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-white leading-tight tracking-normal drop-shadow-sm"
                                        x-text="item.title"></h3>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Floating Side Arrows on Main Slide --}}
                    <div class="absolute inset-y-0 left-4 flex items-center z-30 pointer-events-none" x-show="filteredItems.length > 1">
                        <button @click.stop="prev()"
                                class="pointer-events-auto w-11 h-11 rounded-xl bg-black/35 hover:bg-white text-white hover:text-[#1B2B5E] backdrop-blur-md flex items-center justify-center transition-all hover:scale-105 shadow-xl border border-white/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    </div>
                    <div class="absolute inset-y-0 right-4 flex items-center z-30 pointer-events-none" x-show="filteredItems.length > 1">
                        <button @click.stop="next()"
                                class="pointer-events-auto w-11 h-11 rounded-xl bg-black/35 hover:bg-white text-white hover:text-[#1B2B5E] backdrop-blur-md flex items-center justify-center transition-all hover:scale-105 shadow-xl border border-white/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    {{-- Bottom Progress Bar --}}
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/40 z-30" x-show="filteredItems.length > 1">
                        <div class="h-full bg-[#1B2B5E] transition-[width] duration-75 ease-linear"
                             :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 text-gray-300">
                <svg class="w-14 h-14 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-gray-400 font-medium text-sm">Belum ada foto event. Tambahkan melalui admin panel.</p>
            </div>
        @endif

        {{-- Lightbox Modal --}}
        <div x-show="lightbox.open"
             x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition duration-150" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-black/92 flex items-center justify-center p-4 sm:p-6 backdrop-blur-sm"
             @click.self="lightbox.open = false" @keydown.escape.window="lightbox.open = false">
            <button @click="lightbox.open = false" class="absolute top-6 right-6 text-white/60 hover:text-white transition-colors p-2 rounded-full bg-white/10 hover:bg-white/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="max-w-5xl w-full">
                <img :src="lightbox.src" :alt="lightbox.title" class="w-full max-h-[82vh] object-contain rounded-2xl shadow-2xl">
                <div class="mt-4 text-center">
                    <p class="text-white font-bold text-lg sm:text-xl" x-text="lightbox.title"></p>
                    <p class="text-white/60 text-sm mt-1" x-text="lightbox.location"></p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SLIM SLEEK SINGLE-ROW MARQUEE TICKER --}}
<section class="py-4 sm:py-5 bg-[#0d1836] border-y border-white/10 relative overflow-hidden select-none marquee-container">
    {{-- Side Gradient Fades (Left & Right) --}}
    <div class="absolute inset-y-0 left-0 w-16 sm:w-32 bg-gradient-to-r from-[#0d1836] via-[#0d1836]/90 to-transparent z-20 pointer-events-none"></div>
    <div class="absolute inset-y-0 right-0 w-16 sm:w-32 bg-gradient-to-l from-[#0d1836] via-[#0d1836]/90 to-transparent z-20 pointer-events-none"></div>

    <div class="overflow-hidden flex relative z-10">
        <div class="animate-marquee-left flex items-center gap-8 sm:gap-12 pr-8 sm:pr-12 whitespace-nowrap">
            @php
                $tickerItems = [
                    ['highlight' => '10+', 'text' => 'Event & Aktivasi Sukses'],
                    ['highlight' => 'JADISATU', 'text' => 'Creating Stories, Crafting Moments'],
                    ['highlight' => '100%', 'text' => 'Dedikasi & Komitmen'],
                    ['highlight' => 'SPORT EVENT', 'text' => 'Management Specialist'],
                    ['highlight' => '5.000+', 'text' => 'Peserta Terlibat'],
                    ['highlight' => 'CORPORATE', 'text' => 'Gathering & Outbound'],
                    ['highlight' => '24/7', 'text' => 'Fast Response & Konsultasi'],
                    ['highlight' => 'COMMUNITY', 'text' => 'Brand Activation'],
                    ['highlight' => 'Transparan', 'text' => 'Tanpa Biaya Tersembunyi'],
                    ['highlight' => 'END-TO-END', 'text' => 'Perencanaan s/d Eksekusi'],
                ];
            @endphp

            {{-- Loop 1 --}}
            @foreach($tickerItems as $item)
                <div class="inline-flex items-center gap-2.5">
                    <span class="text-sm sm:text-base font-normal text-white/90 tracking-wide">{{ $item['highlight'] }}</span>
                    <span class="text-white/60 text-xs sm:text-sm font-normal uppercase tracking-wider">{{ $item['text'] }}</span>
                </div>
                <span class="text-[#FF6B35]/80 text-xs font-normal">✦</span>
            @endforeach

            {{-- Loop 2 (Duplicate for Seamless Infinite Loop) --}}
            @foreach($tickerItems as $item)
                <div class="inline-flex items-center gap-2.5">
                    <span class="text-sm sm:text-base font-normal text-white/90 tracking-wide">{{ $item['highlight'] }}</span>
                    <span class="text-white/60 text-xs sm:text-sm font-normal uppercase tracking-wider">{{ $item['text'] }}</span>
                </div>
                <span class="text-[#FF6B35]/80 text-xs font-normal">✦</span>
            @endforeach
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
@if($testimonials->count() > 0)
<section class="py-24 lg:py-32 bg-[#f7f8fc] overflow-hidden" x-data="testimonialSlider()">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="mb-14 fade-up text-center">
            <h2 class="text-3xl lg:text-4xl font-black text-[#1B2B5E]">Kata Mereka</h2>
            <p class="text-gray-400 mt-2.5 text-[14px]">Kepercayaan klien adalah ukuran keberhasilan kami.</p>
        </div>

        <div class="relative overflow-hidden py-4 -my-4">
            <div class="testi-track flex transition-transform duration-500 ease-out" :style="'transform: translateX(-' + (current * step) + '%)'">
                @foreach($testimonials as $testi)
                    <div class="w-[85%] sm:w-[70%] md:w-[46%] lg:w-[31.5%] flex-shrink-0 px-3">
                        <div class="bg-white rounded-2xl p-7 sm:p-8 h-full border border-gray-100/90 shadow-sm hover:shadow-xl hover:border-gray-200 transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <div class="text-[#FF6B35] text-3xl font-serif mb-4 leading-none">“</div>
                                <p class="text-gray-600 leading-relaxed mb-6 text-[15px]">{{ $testi->content }}</p>
                            </div>
                            <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                                @if($testi->photo && Storage::disk('public')->exists($testi->photo))
                                    <img src="{{ asset('storage/'.$testi->photo) }}" alt="{{ $testi->name }}" class="w-11 h-11 rounded-full object-cover flex-shrink-0 ring-2 ring-[#1B2B5E]/10">
                                @else
                                    <div class="w-11 h-11 rounded-full bg-[#1B2B5E] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($testi->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="font-bold text-[#1B2B5E] text-sm truncate">{{ $testi->name }}</div>
                                    <div class="text-gray-400 text-xs truncate">{{ $testi->position }}{{ $testi->company ? ' · '.$testi->company : '' }}</div>
                                </div>
                                <div class="ml-auto flex gap-0.5 flex-shrink-0">
                                    @for($s = 1; $s <= 5; $s++)
                                        <svg class="w-3.5 h-3.5 {{ $s <= $testi->rating ? 'text-[#FFC107]' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($testimonials->count() > 1)
            <div class="flex justify-center items-center gap-3 mt-10 fade-up">
                <button @click="prev()"
                        class="w-10 h-10 rounded-xl bg-white border border-gray-200 hover:border-[#1B2B5E] text-[#1B2B5E] flex items-center justify-center transition-all shadow-sm hover:shadow-md hover:scale-105 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <div class="flex items-center gap-1.5 px-3 py-2 bg-white rounded-xl border border-gray-200/80 shadow-sm">
                    @for($i = 0; $i < $testimonials->count(); $i++)
                        <button @click="goTo({{ $i }})"
                                class="h-2 rounded-full transition-all duration-300"
                                :class="current === {{ $i }} ? 'w-5 bg-[#FF6B35]' : 'w-2 bg-gray-200 hover:bg-gray-300'"></button>
                    @endfor
                </div>

                <button @click="next()"
                        class="w-10 h-10 rounded-xl bg-white border border-gray-200 hover:border-[#1B2B5E] text-[#1B2B5E] flex items-center justify-center transition-all shadow-sm hover:shadow-md hover:scale-105 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        @endif
    </div>
</section>
@endif

{{-- TEAM --}}
@if($team->count() > 0)
<section id="team" class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="mb-14 fade-up">
            <h2 class="text-4xl lg:text-5xl font-black text-[#1B2B5E]">Orang-Orang di Balik JADISATU</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($team as $i => $member)
                <div class="group fade-up" style="transition-delay: {{ $i * 0.08 }}s">
                    <div class="relative overflow-hidden rounded-2xl mb-4 aspect-square bg-gray-100">
                        @if($member->photo && Storage::disk('public')->exists($member->photo))
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-[#1B2B5E] flex items-center justify-center">
                                <span class="text-5xl font-black text-white/20">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        @if($member->instagram || $member->linkedin)
                            <div class="absolute inset-0 bg-[#1B2B5E]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                                @if($member->instagram)
                                    <a href="https://instagram.com/{{ $member->instagram }}" target="_blank" class="text-white/70 hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </a>
                                @endif
                                @if($member->linkedin)
                                    <a href="{{ $member->linkedin }}" target="_blank" class="text-white/70 hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <h3 class="font-bold text-[#1B2B5E] text-base">{{ $member->name }}</h3>
                    <p class="text-gray-400 text-sm font-medium">{{ $member->position }}</p>
                    @if($member->bio)<p class="text-gray-400 text-xs mt-1.5 leading-relaxed">{{ $member->bio }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- WHY US --}}
<section class="py-24 lg:py-32 bg-[#1B2B5E] relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/3 rounded-full -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#FF6B35]/5 rounded-full blur-3xl"></div>
    </div>

    {{-- SPORT SILHOUETTES --}}
    <div class="absolute inset-0 z-[1] pointer-events-none select-none overflow-hidden text-white" aria-hidden="true">

        {{-- Gawang sepakbola (kiri bawah) --}}
        <div class="hidden lg:block absolute bottom-[2%] left-[-2%] w-[380px] xl:w-[440px] opacity-[0.04] sport-float">
            <svg viewBox="0 0 160 100" class="w-full h-auto" fill="none" stroke="currentColor" stroke-linecap="round">
                <g stroke-width="1.5">
                    <path d="M29 22 L29 84"/><path d="M42 22 L42 84"/><path d="M55 22 L55 84"/>
                    <path d="M68 22 L68 84"/><path d="M81 22 L81 84"/><path d="M94 22 L94 84"/>
                    <path d="M107 22 L107 84"/><path d="M120 22 L120 84"/><path d="M133 22 L133 84"/>
                    <path d="M16 32 L144 32"/><path d="M16 42 L144 42"/><path d="M16 52 L144 52"/>
                    <path d="M16 62 L144 62"/><path d="M16 72 L144 72"/><path d="M16 82 L144 82"/>
                </g>
                <path d="M16 84 L16 22 L144 22 L144 84" stroke-width="5"/>
                <path d="M2 84 L158 84" stroke-width="3"/>
            </svg>
        </div>

        {{-- Net badminton (kanan bawah, di belakang kartu) --}}
        <div class="hidden xl:block absolute bottom-[3%] right-[-3%] w-[360px] opacity-[0.032] sport-float2">
            <svg viewBox="0 0 160 100" class="w-full h-auto" fill="none" stroke="currentColor" stroke-linecap="round">
                <path d="M4 88 L156 88" stroke-width="3"/>
                <path d="M16 88 L16 26 M144 88 L144 26" stroke-width="4.5"/>
                <path d="M16 26 Q80 42 144 26" stroke-width="4"/>
                <path d="M16 32 Q80 48 144 32" stroke-width="2"/>
                <g stroke-width="1.4">
                    <path d="M29 29 L29 72"/><path d="M42 31 L42 75"/><path d="M55 33 L55 77"/>
                    <path d="M68 34 L68 78"/><path d="M81 34 L81 78"/><path d="M94 34 L94 78"/>
                    <path d="M107 32 L107 76"/><path d="M120 31 L120 75"/><path d="M133 28 L133 72"/>
                    <path d="M16 40 Q80 56 144 40"/><path d="M16 52 Q80 68 144 52"/><path d="M16 64 Q80 80 144 64"/>
                </g>
                <path d="M16 70 Q80 86 144 70" stroke-width="2.5"/>
            </svg>
        </div>

        {{-- Ring basket (kiri atas) --}}
        <div class="absolute top-[3%] left-[2%] lg:top-[4%] lg:left-[1%] w-24 h-24 lg:w-40 lg:h-40 opacity-[0.05] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 8 L80 8 L80 50 L20 50 Z" stroke-width="4.5"/>
                <path d="M37 25 L63 25 L63 44 L37 44 Z" stroke-width="4"/>
                <ellipse cx="50" cy="54" rx="16" ry="4.5" stroke-width="4.5"/>
                <g stroke-width="2.4">
                    <path d="M35 56 Q38 70 45 80 M42 57 Q43 70 47 81 M50 58 L50 82 M58 57 Q57 70 53 81 M65 56 Q62 70 55 80"/>
                    <path d="M38 64 Q50 69 62 64 M42 72 Q50 77 58 72 M45 79 Q50 83 55 79"/>
                </g>
            </svg>
        </div>

        {{-- Basket — dunk (kiri atas, ke arah ring) --}}
        <div class="hidden lg:block absolute top-[6%] left-[13%] w-44 h-44 xl:w-52 xl:h-52 opacity-[0.055] sport-float2">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="48" cy="26" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M48 35 L46 60"/>
                <path d="M48 39 L34 24 L29 13"/>
                <path d="M48 41 L64 26 L69 15"/>
                <path d="M46 60 L35 80 L31 93"/>
                <path d="M46 60 L60 79 L64 92"/>
                <circle cx="50" cy="8" r="8.5" stroke-width="4.5"/>
            </svg>
        </div>

        {{-- Sepakbola — tendangan ke gawang (kiri bawah) --}}
        <div class="absolute bottom-[4%] left-[6%] lg:bottom-[10%] lg:left-[25%] w-28 h-28 lg:w-44 lg:h-44 xl:w-52 xl:h-52 opacity-[0.06] sport-float4">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="44" cy="20" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M44 29 L41 54"/>
                <path d="M44 34 L26 28"/>
                <path d="M44 36 L62 45"/>
                <path d="M41 54 L36 76 L38 91"/>
                <path d="M41 54 L62 62 L78 55"/>
                <circle cx="89" cy="52" r="8" stroke-width="4.5"/>
            </svg>
        </div>

        {{-- Badminton — smash (kanan atas) --}}
        <div class="absolute top-[2%] right-[3%] lg:top-[5%] lg:right-[6%] w-24 h-24 lg:w-44 lg:h-44 opacity-[0.05] sport-float">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="43" cy="24" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M43 33 L41 57"/>
                <path d="M43 37 L57 21"/>
                <ellipse cx="65" cy="12" rx="8" ry="10.5" transform="rotate(-38 65 12)" stroke-width="4.5"/>
                <path d="M43 41 L27 47"/>
                <path d="M41 57 L29 77 L25 91"/>
                <path d="M41 57 L57 75 L66 87"/>
                <path d="M86 5 L82 13 M86 5 L90 13 M86 5 L86 14" stroke-width="4"/>
                <circle cx="86" cy="4" r="2.5" fill="currentColor" stroke="none"/>
            </svg>
        </div>

        {{-- Lari (kiri tengah-bawah) --}}
        <div class="hidden lg:block absolute bottom-[4%] left-[3%] w-36 h-36 xl:w-44 xl:h-44 opacity-[0.045] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="56" cy="19" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M56 28 L48 53"/>
                <path d="M54 34 L37 26 L33 15"/>
                <path d="M53 38 L70 47 L76 40"/>
                <path d="M48 53 L62 68 L58 87"/>
                <path d="M48 53 L33 65 L38 84"/>
            </svg>
        </div>

        {{-- Tenis (kiri atas, di atas heading) --}}
        <div class="hidden xl:block absolute top-[6%] left-[36%] w-36 h-36 opacity-[0.04] sport-float4">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="40" cy="24" r="8.5" fill="currentColor" stroke="none"/>
                <path d="M40 33 L43 58"/>
                <path d="M40 38 L60 43"/>
                <ellipse cx="74" cy="45" rx="9" ry="11.5" transform="rotate(72 74 45)" stroke-width="4.5"/>
                <path d="M40 36 L24 31"/>
                <path d="M43 58 L31 78 L26 91"/>
                <path d="M43 58 L60 79 L69 88"/>
                <circle cx="16" cy="18" r="5" stroke-width="4"/>
            </svg>
        </div>

        {{-- Sepeda (bawah tengah) --}}
        <div class="hidden xl:block absolute bottom-[5%] left-[45%] w-40 h-40 opacity-[0.04] sport-float2">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="21" cy="76" r="16"/>
                <circle cx="79" cy="76" r="16"/>
                <path d="M21 76 L44 76 L58 52 L79 76 M44 76 L58 52 M58 52 L70 52"/>
                <path d="M70 52 L76 44"/>
                <circle cx="63" cy="24" r="7" fill="currentColor" stroke="none"/>
                <path d="M60 31 L46 46 L58 52" stroke-width="5.5"/>
                <path d="M56 34 L74 44" stroke-width="5.5"/>
                <path d="M46 46 L38 62" stroke-width="5.5"/>
            </svg>
        </div>

        {{-- Bola sepak (celah antar kolom) --}}
        <div class="hidden lg:block absolute top-[28%] left-[46%] w-16 h-16 xl:w-20 xl:h-20 opacity-[0.04] sport-float3">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4.5" stroke-linejoin="round">
                <circle cx="50" cy="50" r="30"/>
                <path d="M50 36 L63.3 45.7 L58.2 61.3 L41.8 61.3 L36.7 45.7 Z" fill="currentColor" stroke="none"/>
                <path d="M50 36 L50 20 M63.3 45.7 L77.6 41.1 M58.2 61.3 L67 73.4 M41.8 61.3 L33 73.4 M36.7 45.7 L22.4 41.1"/>
            </svg>
        </div>

        {{-- Bola basket (kanan bawah) --}}
        <div class="absolute bottom-[3%] right-[6%] lg:bottom-[6%] lg:right-[44%] w-12 h-12 lg:w-16 lg:h-16 opacity-[0.038] sport-float">
            <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4.5">
                <circle cx="50" cy="50" r="30"/>
                <path d="M50 20 L50 80 M20 50 L80 50"/>
                <path d="M22 32 Q50 50 22 68 M78 32 Q50 50 78 68"/>
            </svg>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="fade-up">
                <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight mb-5">Kenapa Harus<br>JADISATU?</h2>
                <p class="text-white/50 leading-relaxed text-[15px]">Bukan sekadar event organizer. Kami adalah partner yang berkomitmen pada kesuksesan setiap event yang Anda percayakan kepada kami.</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-1 items-start gap-3 sm:gap-4 fade-up" style="transition-delay: 0.15s" x-data="{ active: null }">
                @php
                    $whys = [
                        [
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Berpengalaman & Terpercaya',
                            'desc' => 'Didukung tim praktisi event berpengalaman dengan rekam jejak pelaksanaan berbagai jenis sport event dan aktivasi komunitas yang solid di Indonesia.'
                        ],
                        [
                            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                            'title' => 'Eksekusi Cepat & Tepat',
                            'desc' => 'Kami bergerak cepat, adaptif, dan terorganisir tanpa mengorbankan kualitas. Deadline dan rundown adalah komitmen mutlak kami.'
                        ],
                        [
                            'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'title' => 'Full Dedication',
                            'desc' => 'Setiap project ditangani langsung dengan perhatian penuh dari tim inti. Kami memperlakukan event Anda selayaknya event kami sendiri.'
                        ],
                        [
                            'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Harga Transparan',
                            'desc' => 'Tidak ada biaya tersembunyi. Proposal RAB kami susun secara jelas, detail, fleksibel, dan terukur sesuai anggaran Anda.'
                        ],
                    ];
                @endphp
                @foreach($whys as $i => $why)
                    <div class="rounded-2xl transition-all duration-300 border overflow-hidden self-start"
                         :class="active === {{ $i }} ? 'bg-white/12 border-white/25 shadow-xl' : 'bg-white/5 border-white/10 hover:bg-white/8 hover:border-white/15'">
                        <button @click="active = (active === {{ $i }} ? null : {{ $i }})"
                                class="w-full text-left p-3.5 sm:p-5 flex items-center justify-between gap-2 sm:gap-4 cursor-pointer select-none">
                            <div class="flex items-center gap-2.5 sm:gap-4 min-w-0">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                     :class="active === {{ $i }} ? 'bg-white/20 text-white shadow-sm' : 'bg-white/10 text-white/70'">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $why['icon'] }}"/></svg>
                                </div>
                                <h4 class="font-bold text-white text-xs sm:text-base tracking-tight leading-snug break-words"
                                    :class="active === {{ $i }} ? 'text-white' : 'text-white/90'">
                                    {{ $why['title'] }}
                                </h4>
                            </div>
                            <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-transform duration-350 ease-out"
                                 :class="active === {{ $i }} ? 'rotate-180 text-white bg-white/20' : 'text-white/40 bg-white/5'">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                        {{-- Ultra-smooth CSS Grid 0fr to 1fr auto height transition --}}
                        <div class="grid transition-[grid-template-rows] duration-350 ease-out"
                             :class="active === {{ $i }} ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
                            <div class="overflow-hidden">
                                <div class="px-3.5 pb-3.5 sm:px-5 sm:pb-5 lg:pl-[4.25rem] text-white/70 text-[11px] sm:text-sm leading-relaxed border-t border-white/5 pt-2.5 transition-opacity duration-300"
                                     :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0'">
                                    <p>{{ $why['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CONTACT --}}
<section id="contact" class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16">
            <div class="fade-up">
                <h2 class="text-3xl lg:text-4xl font-black text-[#1B2B5E] leading-tight mb-4">Mari Wujudkan<br>Event Impian Anda</h2>
                <p class="text-gray-400 mb-10 text-[15px]">Ceritakan kebutuhan event Anda. Tim kami siap memberikan proposal terbaik dalam 24 jam.</p>

                <div class="space-y-5">
                    @php
                        $contactPhone = \App\Models\SiteSetting::get('contact_phone', '0895-8023-66010 (Ayu)');
                        $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@jadisatukreatif.com');
                        $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Jalan Discovery Cielo III, Discovery Cielo, Pondok Aren, Banten 15227, ID');
                        $wa = \App\Models\SiteSetting::get('contact_whatsapp', '62895802366010');
                        $contactInfo = [
                            [
                                'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                                'label' => 'WhatsApp / Telepon',
                                'value' => $contactPhone,
                                'link' => 'https://wa.me/' . $wa . '?text=' . urlencode('Halo JADISATU (Ayu), saya ingin konsultasi event.')
                            ],
                            [
                                'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                'label' => 'Email',
                                'value' => $contactEmail,
                                'link' => 'mailto:' . $contactEmail
                            ],
                            [
                                'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
                                'label' => 'Lokasi Kantor',
                                'value' => $contactAddress,
                                'link' => 'https://maps.google.com/?q=' . urlencode($contactAddress)
                            ],
                        ];
                    @endphp
                    @foreach($contactInfo as $info)
                        <div class="flex gap-4 items-start">
                            <div class="w-9 h-9 rounded-lg bg-[#1B2B5E]/5 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-[#1B2B5E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $info['icon'] }}"/></svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 mb-0.5">{{ $info['label'] }}</div>
                                @if($info['link'])
                                    <a href="{{ $info['link'] }}" target="{{ str_starts_with($info['link'], 'http') ? '_blank' : '_self' }}" class="text-[#1B2B5E] font-semibold text-sm hover:text-[#FF6B35] transition-colors leading-relaxed block">{{ $info['value'] }}</a>
                                @else
                                    <span class="text-[#1B2B5E] font-semibold text-sm leading-relaxed block">{{ $info['value'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo JADISATU (Ayu), saya ingin konsultasi event.') }}" target="_blank"
                   class="mt-10 inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#1db954] text-white font-bold px-7 py-3.5 rounded-xl transition-all hover:shadow-lg hover:shadow-green-500/25 hover:-translate-y-0.5 text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Chat via WhatsApp (Ayu)
                </a>
            </div>

            <div class="fade-up" style="transition-delay: 0.15s">
                <div class="bg-[#f7f8fc] rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1B2B5E] mb-2">Kirim Pesan</h3>
                    <p class="text-xs text-gray-400 mb-6">Konsultasikan ide dan konsep event Anda bersama tim kami.</p>

                    @if(session('contact_success'))
                        <div x-data="{ show: true }" x-show="show" class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-xs sm:text-sm flex items-start justify-between gap-3 animate-fade-in">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="leading-relaxed font-medium">{{ session('contact_success') }}</span>
                            </div>
                            <button @click="show = false" class="text-green-500 hover:text-green-700 font-bold text-lg leading-none">&times;</button>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1.5 font-medium">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Anda" required
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm transition-all">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1.5 font-medium">Perusahaan / Organisasi</label>
                                <input type="text" name="company" value="{{ old('company') }}" placeholder="PT / Komunitas / Personal"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] text-sm transition-all">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1.5 font-medium">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@anda.com" required
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm transition-all">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1.5 font-medium">Nomor WhatsApp / HP</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1.5 font-medium">Jenis Event</label>
                            <select name="event_type" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] text-sm text-gray-700">
                                <option value="">Pilih jenis event...</option>
                                <option {{ old('event_type') == 'Sport Event' ? 'selected' : '' }}>Sport Event</option>
                                <option {{ old('event_type') == 'Corporate Gathering' ? 'selected' : '' }}>Corporate Gathering</option>
                                <option {{ old('event_type') == 'Team Building' ? 'selected' : '' }}>Team Building</option>
                                <option {{ old('event_type') == 'Community Activation' ? 'selected' : '' }}>Community Activation</option>
                                <option {{ old('event_type') == 'Festival / Exhibition' ? 'selected' : '' }}>Festival / Exhibition</option>
                                <option {{ old('event_type') == 'Production' ? 'selected' : '' }}>Production</option>
                                <option {{ old('event_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1.5 font-medium">Pesan / Kebutuhan Event <span class="text-red-500">*</span></label>
                            <textarea name="message" rows="4" placeholder="Ceritakan kebutuhan event, estimasi tanggal, dan jumlah peserta..." required
                                      class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm transition-all resize-none">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="w-full bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-bold py-3.5 rounded-xl transition-all text-sm shadow-md hover:shadow-lg hover:shadow-[#1B2B5E]/20">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-[#0d1a3a] text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-9 w-9 object-contain rounded-xl overflow-hidden shadow-sm">
                    <span class="font-extrabold text-xl tracking-wide">JADISATU</span>
                </div>
                <p class="text-white/40 leading-relaxed text-sm max-w-sm">
                    {{ \App\Models\SiteSetting::get('tagline', 'Creating Stories, Crafting Moments') }}
                    event organizer profesional dengan spesialisasi di sport events.
                </p>
                <div class="flex gap-2 mt-6">
                    @php
                        $ig = \App\Models\SiteSetting::get('instagram');
                        $fb = \App\Models\SiteSetting::get('facebook');
                    @endphp
                    @if($ig)
                        <a href="https://instagram.com/{{ $ig }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all" title="Instagram">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    @endif
                    @if($fb)
                        <a href="https://facebook.com/{{ $fb }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all" title="Facebook">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-5 text-xs uppercase tracking-widest text-white/30">Layanan</h4>
                <ul class="space-y-2.5 text-sm text-white/35">
                    @forelse($services->take(5) as $svc)
                        <li><a href="#services" class="hover:text-white transition-colors">{{ $svc->title }}</a></li>
                    @empty
                        <li><a href="#services" class="hover:text-white transition-colors">Sport Event</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">Corporate Event</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">Community Activation</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">Festival & Exhibition</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">Production</a></li>
                    @endforelse
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-5 text-xs uppercase tracking-widest text-white/30">Kontak</h4>
                <ul class="space-y-2.5 text-sm text-white/40">
                    <li>
                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('contact_whatsapp', '62895802366010') }}?text={{ urlencode('Halo JADISATU (Ayu), saya ingin konsultasi event.') }}" target="_blank" class="hover:text-white transition-colors">
                            {{ \App\Models\SiteSetting::get('contact_phone', '0895-8023-66010 (Ayu)') }}
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ \App\Models\SiteSetting::get('contact_email', 'info@jadisatukreatif.com') }}" class="hover:text-white transition-colors">
                            {{ \App\Models\SiteSetting::get('contact_email', 'info@jadisatukreatif.com') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://maps.google.com/?q={{ urlencode(\App\Models\SiteSetting::get('contact_address', 'Jalan Discovery Cielo III, Discovery Cielo, Pondok Aren, Banten 15227, ID')) }}" target="_blank" class="hover:text-white transition-colors leading-relaxed block">
                            {{ \App\Models\SiteSetting::get('contact_address', 'Jalan Discovery Cielo III, Discovery Cielo, Pondok Aren, Banten 15227, ID') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/8 pt-8 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-white/25 text-xs">© {{ date('Y') }} JADISATU. All rights reserved. | Developed by RZ Digital Creative</p>
            <p class="text-white/25 text-xs italic">Creating Stories, Crafting Moments</p>
        </div>
    </div>
</footer>

@endsection

@push('scripts')
<script>
function heroSlider() {
    return {
        current: 0,
        total: {{ $heroSlides->count() > 0 ? $heroSlides->count() : 1 }},
        interval: 3500,
        progress: 0,
        progressTimer: null,
        init() {
            if (this.total > 1) this.startAuto();
        },
        startAuto() {
            this.stopAuto();
            this.progress = 0;
            if (this.total > 1) {
                const step = 40;
                this.progressTimer = setInterval(() => {
                    this.progress += (step / this.interval) * 100;
                    if (this.progress >= 100) {
                        this.progress = 0;
                        this.next();
                    }
                }, step);
            }
        },
        stopAuto() {
            if (this.progressTimer) clearInterval(this.progressTimer);
        },
        next() {
            this.current = (this.current + 1) % this.total;
            this.startAuto();
        },
        prev() {
            this.current = (this.current - 1 + this.total) % this.total;
            this.startAuto();
        },
        goTo(i) {
            this.current = i;
            this.startAuto();
        }
    }
}

function gallery() {
    return {
        filter: 'all',
        current: 0,
        interval: 3500,
        isPaused: false,
        progress: 0,
        progressTimer: null,
        lightbox: { open: false, src: '', title: '', location: '' },
        items: [
            @foreach($galleries as $item)
            {
                id: {{ $item->id }},
                title: @json($item->title),
                category: @json($item->category ?? 'sport'),
                location: @json($item->location ?? ''),
                is_featured: {{ $item->is_featured ? 'true' : 'false' }},
                image_url: @json(asset('storage/'.$item->image_path))
            },
            @endforeach
        ],
        get filteredItems() {
            if (this.filter === 'all') return this.items;
            return this.items.filter(i => i.category === this.filter);
        },
        init() {
            this.startAuto();
            this.$watch('filter', () => {
                this.current = 0;
                this.startAuto();
            });
        },
        startAuto() {
            this.stopAuto();
            this.progress = 0;
            if (this.filteredItems.length > 1) {
                const step = 40;
                this.progressTimer = setInterval(() => {
                    if (!this.isPaused && !this.lightbox.open) {
                        this.progress += (step / this.interval) * 100;
                        if (this.progress >= 100) {
                            this.progress = 0;
                            this.next();
                        }
                    }
                }, step);
            }
        },
        stopAuto() {
            if (this.progressTimer) clearInterval(this.progressTimer);
        },
        next() {
            if (this.filteredItems.length === 0) return;
            this.current = (this.current + 1) % this.filteredItems.length;
            this.startAuto();
        },
        prev() {
            if (this.filteredItems.length === 0) return;
            this.current = (this.current - 1 + this.filteredItems.length) % this.filteredItems.length;
            this.startAuto();
        },
        goTo(i) {
            this.current = i;
            this.startAuto();
        },
        openLightbox(src, title, location) {
            this.lightbox = { open: true, src, title, location };
        }
    }
}

function testimonialSlider() {
    return {
        current: 0,
        total: {{ $testimonials->count() }},
        get step() {
            if (window.innerWidth >= 1024) return 31.5;
            if (window.innerWidth >= 768) return 46;
            return 85;
        },
        get maxIndex() {
            if (window.innerWidth >= 1024) return Math.max(0, this.total - 3);
            if (window.innerWidth >= 768) return Math.max(0, this.total - 2);
            return Math.max(0, this.total - 1);
        },
        next() {
            if (this.current < this.maxIndex) {
                this.current++;
            } else {
                this.current = 0;
            }
        },
        prev() {
            if (this.current > 0) {
                this.current--;
            } else {
                this.current = this.maxIndex;
            }
        },
        goTo(i) {
            this.current = Math.min(i, this.maxIndex);
        }
    }
}

// Navbar scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
}, { passive: true });

// Fade up on scroll
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
}, { threshold: 0.08 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@if(session('success') || session('contact_success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'PESAN TERKIRIM',
            text: @json(session('success') ?? session('contact_success')),
            icon: 'success',
            iconColor: '#FF6B35',
            confirmButtonText: 'OKE, MENGERTI',
            confirmButtonColor: '#1B2B5E',
            background: '#ffffff',
            color: '#1B2B5E',
            customClass: {
                popup: 'rounded-none shadow-2xl border border-gray-200',
                confirmButton: 'rounded-none px-6 py-3 font-bold text-xs tracking-wider uppercase shadow-none',
                icon: 'rounded-none'
            }
        });
    }
});
</script>
@endif
@endpush
