<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\EventGallery;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Stat;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'heroSlides' => HeroSlide::active()->get(),
            'services' => Service::active()->get(),
            'stats' => Stat::active()->get(),
            'galleries' => EventGallery::active()->get(),
            'testimonials' => Testimonial::active()->get(),
            'team' => TeamMember::active()->get(),
        ]);
    }
}
