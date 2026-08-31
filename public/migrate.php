<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('LARAVEL_START', microtime(true));

$possiblePaths = [
    __DIR__ . '/../repositories/meraki-jadisatucompro',
    __DIR__ . '/../repositories/jadisatu',
    __DIR__ . '/../jadisatu',
    __DIR__ . '/..',
];

$appPath = null;
foreach ($possiblePaths as $path) {
    if (file_exists($path . '/vendor/autoload.php')) {
        $appPath = realpath($path);
        break;
    }
}

if (!$appPath) {
    die("App path not found");
}

require $appPath . '/vendor/autoload.php';
$app = require_once $appPath . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$results = [];

try {
    $kernel->call('migrate', ['--force' => true]);
    $results[] = "=== MIGRATE ===\n" . $kernel->output();

    $kernel->call('db:seed', ['--force' => true]);
    $results[] = "=== SEED ===\n" . $kernel->output();

    $kernel->call('storage:link');
    $results[] = "=== STORAGE LINK ===\n" . $kernel->output();

    $kernel->call('optimize:clear');
    $results[] = "=== OPTIMIZE CLEAR ===\n" . $kernel->output();

    echo '<div style="font-family:sans-serif;padding:30px;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;border-radius:8px;max-width:800px;margin:40px auto;">
        <h2 style="margin-top:0;">🎉 Migrasi & Setup Database Sukses!</h2>
        <pre style="background:#fff;padding:15px;border-radius:6px;border:1px solid #dcfce7;overflow-x:auto;">' . htmlspecialchars(implode("\n\n", $results)) . '</pre>
        <p style="margin-top:20px;"><a href="/" style="display:inline-block;padding:10px 20px;background:#16a34a;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;">👉 Buka Homepage Website</a></p>
    </div>';
} catch (Throwable $e) {
    echo '<div style="font-family:sans-serif;padding:30px;background:#fef2f2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;max-width:800px;margin:40px auto;">
        <h2 style="margin-top:0;">❌ Gagal Migrasi</h2>
        <p><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>
        <pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>
    </div>';
}
