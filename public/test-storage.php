<?php
header('Content-Type: text/html; charset=utf-8');

$storageApp = '/home/jadj3934/repositories/meraki-jadisatucompro/storage/app/public';
$publicStorage = '/home/jadj3934/public_html/storage';

echo "<h2>Diagnostik Storage Foto</h2>";

echo "<p><strong>Storage App Public Path:</strong> $storageApp</p>";
echo "<p>Folder Exists: " . (is_dir($storageApp) ? 'YES' : 'NO') . "</p>";

if (is_dir($storageApp)) {
    echo "<p><strong>Isi Folder $storageApp:</strong></p><pre>";
    print_r(scandir($storageApp));
    if (is_dir($storageApp . '/gallery')) {
        echo "\nIsi gallery:\n";
        print_r(scandir($storageApp . '/gallery'));
    }
    echo "</pre>";
}

echo "<hr><p><strong>Public HTML Storage Path:</strong> $publicStorage</p>";
echo "<p>Is Link: " . (is_link($publicStorage) ? 'YES' : 'NO') . "</p>";
echo "<p>Is Dir: " . (is_dir($publicStorage) ? 'YES' : 'NO') . "</p>";
if (is_link($publicStorage)) {
    echo "<p>Link Target: " . readlink($publicStorage) . "</p>";
}

