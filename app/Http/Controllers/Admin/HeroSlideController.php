<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        return view('admin.hero.index', ['slides' => HeroSlide::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('admin.hero.form', ['slide' => new HeroSlide()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'required|image|max:5120',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data['image_path'] = $request->file('image')->store('hero', 'public');
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image']);

        HeroSlide::create($data);
        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(HeroSlide $hero)
    {
        return view('admin.hero.form', ['slide' => $hero]);
    }

    public function update(Request $request, HeroSlide $hero)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:5120',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($hero->image_path);
            $data['image_path'] = $request->file('image')->store('hero', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image']);

        $hero->update($data);
        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(HeroSlide $hero)
    {
        Storage::disk('public')->delete($hero->image_path);
        $hero->delete();
        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil dihapus.');
    }
}
