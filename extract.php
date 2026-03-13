<?php
// Extract bazargardi_deploy.zip on the server
// Access this file at: http://gardibazar.unaux.com/extract.php
// DELETE THIS FILE after extraction is complete!

set_time_limit(300);
ini_set('memory_limit', '256M');

echo "<h1>Gardi Bazar - Server Extraction</h1>";
echo "<pre>";

$zipFile = __DIR__ . '/bazargardi_deploy.zip';

if (!file_exists($zipFile)) {
    echo "ERROR: bazargardi_deploy.zip not found!\n";
    echo "Make sure the zip file is uploaded to htdocs/\n";
    exit;
}

echo "ZIP file found: " . round(filesize($zipFile) / 1024 / 1024, 2) . " MB\n";

$zip = new ZipArchive();
$result = $zip->open($zipFile);

if ($result !== TRUE) {
    echo "ERROR: Cannot open zip file. Error code: $result\n";
    exit;
}

echo "Files in archive: " . $zip->numFiles . "\n";
echo "Extracting...\n\n";

$extracted = $zip->extractTo(__DIR__);

if ($extracted) {
    echo "SUCCESS! All files extracted.\n";
    $zip->close();
    
    // Clean up zip file to save space
    // unlink($zipFile);
    // echo "Zip file deleted to save space.\n";
    
    echo "\n========================================\n";
    echo "NEXT STEPS:\n";
    echo "1. Visit http://gardibazar.unaux.com to check the site\n";
    echo "2. DELETE this extract.php file for security!\n";
    echo "3. Run migrations if needed\n";
    echo "========================================\n";
} else {
    echo "ERROR: Extraction failed!\n";
    $zip->close();
}

echo "</pre>";
?>
