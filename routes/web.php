<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\EventGalleryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', fn () => redirect('/#contact'));
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send')->middleware('throttle:10,1');

// Fallback Route untuk melayani file gambar storage di hosting tanpa symlink
Route::get('/storage/{path}', function (string $path) {
    $paths = [
        storage_path('app/public/' . $path),
        public_path('storage/' . $path),
        base_path('storage/app/public/' . $path),
    ];
    foreach ($paths as $file) {
        if (file_exists($file) && !is_dir($file)) {
            $mime = mime_content_type($file) ?: 'application/octet-stream';
            return response()->file($file, ['Content-Type' => $mime]);
        }
    }
    abort(404);
})->where('path', '.*');

// Temporary Helper Route for Setup without Terminal
Route::get('/install-db-secret', function () {
    $results = [];
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $results[] = "=== MIGRATE ===\n" . \Illuminate\Support\Facades\Artisan::output();

        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        $results[] = "=== SEED ===\n" . \Illuminate\Support\Facades\Artisan::output();

        // Sinkronisasi folder storage langsung ke public_html/storage
        $src = storage_path('app/public');
        $dst = public_path('storage');
        if (!is_dir($dst)) {
            @mkdir($dst, 0755, true);
        }
        if (is_dir($src)) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($src, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );
            foreach ($iterator as $item) {
                $sub = $iterator->getSubPathName();
                $target = $dst . DIRECTORY_SEPARATOR . $sub;
                if ($item->isDir()) {
                    if (!is_dir($target)) {
                        @mkdir($target, 0755, true);
                    }
                } else {
                    @copy($item->getPathname(), $target);
                }
            }
        }
        $results[] = "=== STORAGE DIRECTORY ===\nDirect storage directory synced: OK";

        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $results[] = "=== OPTIMIZE CLEAR ===\n" . \Illuminate\Support\Facades\Artisan::output();

        return '<div style="font-family:sans-serif;padding:30px;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;border-radius:8px;max-width:800px;margin:40px auto;">
            <h2 style="margin-top:0;">🎉 Setup & Migrasi Sukses!</h2>
            <pre style="background:#fff;padding:15px;border-radius:6px;border:1px solid #dcfce7;overflow-x:auto;">' . htmlspecialchars(implode("\n\n", $results)) . '</pre>
            <p style="margin-top:20px;"><a href="/" style="display:inline-block;padding:10px 20px;background:#16a34a;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;">👉 Buka Homepage Website</a></p>
        </div>';
    } catch (\Throwable $e) {
        return '<div style="font-family:sans-serif;padding:30px;background:#fef2f2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;max-width:800px;margin:40px auto;">
            <h2 style="margin-top:0;">❌ Setup Gagal</h2>
            <p><strong>Pesan Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>
            <p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ' baris ' . $e->getLine() . '</p>
            <pre style="background:#fff;padding:15px;border-radius:6px;border:1px solid #fee2e2;overflow-x:auto;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>
        </div>';
    }
});

// SEO Sitemap for Google Search Console
Route::get('/sitemap.xml', function () {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . url('/') . '</loc>' . "\n";
    $xml .= '    <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $xml .= '    <changefreq>weekly</changefreq>' . "\n";
    $xml .= '    <priority>1.0</priority>' . "\n";
    $xml .= '  </url>' . "\n";
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// Auth (generated by Breeze)
require __DIR__.'/auth.php';

// Admin Panel
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero', HeroSlideController::class)->except(['show']);
    Route::resource('gallery', EventGalleryController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('team', TeamMemberController::class)->except(['show']);
    Route::resource('stats', StatController::class)->except(['show']);

    // Pesan Masuk (Inbox)
    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
    Route::post('messages/mark-all-read', [ContactMessageController::class, 'markAllRead'])->name('messages.mark-all-read');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
