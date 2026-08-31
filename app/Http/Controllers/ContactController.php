<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:150',
            'company'    => 'nullable|string|max:150',
            'email'      => 'required|email|max:150',
            'phone'      => 'nullable|string|max:50',
            'event_type' => 'nullable|string|max:100',
            'message'    => 'required|string|max:3000',
        ]);

        $contactMessage = ContactMessage::create($validated);

        // Send email notification to info@jadisatukreatif.com
        try {
            Mail::to('info@jadisatukreatif.com')->send(new NewContactMessageMail($contactMessage));
        } catch (\Exception $e) {
            Log::error('Failed to send contact form notification email: ' . $e->getMessage());
        }

        return redirect('/#contact')
            ->with('success', 'Terima kasih! Pesan dan kebutuhan event Anda telah terkirim. Tim JADISATU akan segera menghubungi Anda.');
    }
}
