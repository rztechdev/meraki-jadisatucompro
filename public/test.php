<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Diagnostik Server JADISATU</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 24px; margin-bottom: 20px; border: 1px solid #334155; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-weight: bold; font-size: 14px; }
        .ok { background: #166534; color: #bbf7d0; }
        .fail { background: #991b1b; color: #fecaca; }
        h1, h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td, th { padding: 10px; border-bottom: 1px solid #334155; text-align: left; }
        pre { background: #0f172a; padding: 12px; border-radius: 6px; overflow-x: auto; color: #38bdf8; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 Diagnostik Hosting JADISATU</h1>

    <div class="card">
        <h2>1. Versi PHP</h2>
        <?php
        $phpVersion = phpversion();
        $isPhpOk = version_compare($phpVersion, '8.2.0', '>=');
        ?>
        <p>Versi PHP Aktif: <strong><?= $phpVersion ?></strong> 
            <span class="badge <?= $isPhpOk ? 'ok' : 'fail' ?>"><?= $isPhpOk ? 'OK (Laravel 12 Support)' : 'PERLU DIUBAH KE PHP 8.2+' ?></span>
        </p>
    </div>

    <div class="card">
        <h2>2. Deteksi Folder Laravel</h2>
        <?php
        $checks = [
            'Repo Folder' => '/home/jadj3934/repositories/meraki-jadisatucompro',
            'Vendor Autoload' => '/home/jadj3934/repositories/meraki-jadisatucompro/vendor/autoload.php',
            'Bootstrap App' => '/home/jadj3934/repositories/meraki-jadisatucompro/bootstrap/app.php',
            'File .env' => '/home/jadj3934/repositories/meraki-jadisatucompro/.env',
            'Storage Folder' => '/home/jadj3934/repositories/meraki-jadisatucompro/storage',
        ];
        ?>
        <table>
            <tr><th>Komponen</th><th>Path</th><th>Status</th></tr>
            <?php foreach ($checks as $name => $path): ?>
                <?php $exists = file_exists($path); ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><code><?= $path ?></code></td>
                    <td><span class="badge <?= $exists ? 'ok' : 'fail' ?>"><?= $exists ? 'DITEMUKAN' : 'TIDAK ADA' ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h2>3. Ekstensi PHP Wajib</h2>
        <?php
        $exts = ['pdo_mysql', 'mbstring', 'openssl', 'fileinfo', 'gd', 'zip', 'xml', 'curl', 'bcmath'];
        ?>
        <table>
            <tr><th>Ekstensi</th><th>Status</th></tr>
            <?php foreach ($exts as $ext): ?>
                <?php $loaded = extension_loaded($ext); ?>
                <tr>
                    <td><code><?= $ext ?></code></td>
                    <td><span class="badge <?= $loaded ? 'ok' : 'fail' ?>"><?= $loaded ? 'AKTIF' : 'NON-AKTIF' ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
