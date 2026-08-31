<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\EventGallery;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'heroCount' => HeroSlide::count(),
            'galleryCount' => EventGallery::count(),
            'serviceCount' => Service::count(),
            'testimonialCount' => Testimonial::count(),
            'totalMessagesCount' => ContactMessage::count(),
            'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
