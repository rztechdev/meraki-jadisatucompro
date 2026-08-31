<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Primary SEO Meta Tags --}}
    <title>@yield('title', 'JADISATU — Sport & Corporate Event Organizer Profesional')</title>
    <meta name="title" content="@yield('meta_title', 'JADISATU — Sport & Corporate Event Organizer Profesional')">
    <meta name="description" content="@yield('meta_description', 'JADISATU adalah event organizer profesional di Indonesia dengan spesialisasi di sport events, corporate gathering, team building, festival, dan brand activation.')">
    <meta name="keywords" content="@yield('meta_keywords', 'event organizer, eo sport jakarta, event organizer banten, corporate gathering, event organizer tangerang selatan, eo lari maraton, turnamen olahraga, outbound banten, jadisatu, jadisatu kreatif')">
    <meta name="author" content="JADISATU Kreatif">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Local SEO & Geo Tags (Google Search & Maps Ranking) --}}
    <meta name="geo.region" content="ID-BT">
    <meta name="geo.placename" content="Pondok Aren, Tangerang Selatan, Banten">
    <meta name="geo.position" content="-6.2735;106.7063">
    <meta name="ICBM" content="-6.2735, 106.7063">

    {{-- Open Graph / Facebook / WhatsApp / LinkedIn --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'JADISATU — Creating Stories, Crafting Moments')">
    <meta property="og:description" content="@yield('og_description', 'Wujudkan event olahraga, corporate gathering, dan aktivasi brand tak terlupakan bersama JADISATU. Konsultasi dan proposal dalam 24 jam.')">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:image:alt" content="JADISATU Logo">
    <meta property="og:site_name" content="JADISATU">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'JADISATU — Creating Stories, Crafting Moments')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Event organizer profesional dengan spesialisasi di sport events dan corporate gathering di seluruh Indonesia.')">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

    {{-- Favicons & App Icons (Rounded Corner matching Logo) --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/favicon-rounded.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-180x180.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">
    <meta name="theme-color" content="#1B2B5E">
    <meta name="apple-mobile-web-app-title" content="JADISATU">
    <meta name="application-name" content="JADISATU">

    {{-- JSON-LD Structured Data for Google Search Console & Rich Snippets --}}
    @php
        $schemaData = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => url('/') . '/#organization',
                    'name' => 'JADISATU',
                    'alternateName' => 'JADISATU Kreatif',
                    'url' => url('/'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        '@id' => url('/') . '/#logo',
                        'url' => asset('images/logo.png'),
                        'caption' => 'JADISATU Logo'
                    ],
                    'image' => asset('images/logo.png'),
                    'description' => 'Event organizer profesional dengan spesialisasi di sport events, corporate gathering, team building, dan brand activation di seluruh Indonesia.',
                    'email' => \App\Models\SiteSetting::get('contact_email', 'info@jadisatukreatif.com'),
                    'telephone' => '+62895802366010',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Jalan Discovery Cielo III, Discovery Cielo',
                        'addressLocality' => 'Pondok Aren',
                        'addressRegion' => 'Banten',
                        'postalCode' => '15227',
                        'addressCountry' => 'ID'
                    ],
                    'sameAs' => [
                        'https://instagram.com/' . \App\Models\SiteSetting::get('instagram', 'jadisatu.kreatif')
                    ],
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'telephone' => '+62895802366010',
                        'contactType' => 'customer service',
                        'areaServed' => 'ID',
                        'availableLanguage' => ['Indonesian', 'English']
                    ]
                ],
                [
                    '@type' => 'LocalBusiness',
                    '@id' => url('/') . '/#localbusiness',
                    'name' => 'JADISATU Event Organizer',
                    'url' => url('/'),
                    'logo' => asset('images/logo.png'),
                    'image' => asset('images/logo.png'),
                    'telephone' => '+62895802366010',
                    'priceRange' => '$$',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Jalan Discovery Cielo III, Discovery Cielo',
                        'addressLocality' => 'Pondok Aren',
                        'addressRegion' => 'Banten',
                        'postalCode' => '15227',
                        'addressCountry' => 'ID'
                    ],
                    'geo' => [
                        '@type' => 'GeoCoordinates',
                        'latitude' => -6.2735,
                        'longitude' => 106.7063
                    ],
                    'openingHoursSpecification' => [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                        'opens' => '08:00',
                        'closes' => '18:00'
                    ]
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '/#website',
                    'url' => url('/'),
                    'name' => 'JADISATU',
                    'description' => 'Creating Stories, Crafting Moments — Sport & Corporate Event Organizer',
                    'publisher' => [
                        '@id' => url('/') . '/#organization'
                    ],
                    'inLanguage' => 'id-ID'
                ]
            ]
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    {{-- Fonts & Assets --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased selection:bg-[#FF6B35] selection:text-white">
    @yield('content')
    @stack('scripts')
</body>
</html>
