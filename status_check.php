#!/usr/bin/env php
<?php
/**
 * AltoMusic CI4 Project Status Report
 * Verifies all components are properly configured
 */

echo "\n";
echo "═══════════════════════════════════════════════════════════════\n";
echo "  AltoMusic CodeIgniter 4 - Project Status Report\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

$projectPath = __DIR__;
$checks = [];

// 1. Check Configuration Files
echo "1. Configuration Files:\n";
$configFiles = [
    '.env' => 'Database configuration',
    'app/Config/App.php' => 'Application settings',
    'app/Config/Routes.php' => 'URL routing',
    'app/Config/Database.php' => 'Database driver config',
];

foreach ($configFiles as $file => $desc) {
    $path = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $file);
    $exists = file_exists($path);
    $status = $exists ? '✓' : '✗';
    echo "   $status $file ($desc)\n";
    $checks['config_' . basename($file)] = $exists;
}

// 2. Check Controller Files
echo "\n2. Controller Files:\n";
$controllers = [
    'app/Controllers/BaseController.php' => 'Base controller',
    'app/Controllers/Home.php' => 'Home page',
    'app/Controllers/Site.php' => 'Public website',
    'app/Controllers/Auth.php' => 'Authentication',
    'app/Controllers/Administrator.php' => 'Admin dashboard',
    'app/Controllers/Configs.php' => 'Configuration management',
    'app/Controllers/Api/Profile.php' => 'API profile',
];

foreach ($controllers as $file => $desc) {
    $path = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $file);
    $exists = file_exists($path);
    $status = $exists ? '✓' : '✗';
    echo "   $status $file ($desc)\n";
    $checks['controller_' . basename($file, '.php')] = $exists;
}

// 3. Check Model Files
echo "\n3. Model Files:\n";
$models = [
    'app/Models/Crud.php' => 'CRUD operations',
];

foreach ($models as $file => $desc) {
    $path = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $file);
    $exists = file_exists($path);
    $status = $exists ? '✓' : '✗';
    echo "   $status $file ($desc)\n";
    $checks['model_' . basename($file, '.php')] = $exists;
}

// 4. Check Directory Structure
echo "\n4. Directory Structure:\n";
$directories = [
    'app' => 'Application code',
    'app/Config' => 'Configuration',
    'app/Controllers' => 'Controllers',
    'app/Models' => 'Models',
    'app/Views' => 'View templates',
    'public' => 'Public files',
    'writable' => 'Writable directory',
    'writable/cache' => 'Cache folder',
    'writable/logs' => 'Log folder',
    'writable/session' => 'Session folder',
    'writable/uploads' => 'Upload folder',
];

foreach ($directories as $dir => $desc) {
    $path = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $dir);
    $exists = is_dir($path);
    $status = $exists ? '✓' : '✗';
    echo "   $status $dir/ ($desc)\n";
    $checks['dir_' . str_replace('/', '_', $dir)] = $exists;
}

// 5. Check Upload Subdirectories
echo "\n5. Upload Subdirectories:\n";
$uploadDirs = ['ktp', 'bukti', 'galeri', 'berita', 'event', 'logo', 'user', 'gambar'];
foreach ($uploadDirs as $dir) {
    $path = $projectPath . DIRECTORY_SEPARATOR . 'writable' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $dir;
    $exists = is_dir($path);
    $status = $exists ? '✓' : '✗';
    echo "   $status writable/uploads/$dir/\n";
    $checks['upload_' . $dir] = $exists;
}

// 6. Check Permissions
echo "\n6. File Permissions:\n";
$permissionChecks = [
    'writable' => 'Writable directory must be writable',
    'writable/cache' => 'Cache directory must be writable',
    'writable/logs' => 'Logs directory must be writable',
    'writable/session' => 'Session directory must be writable',
    'writable/uploads' => 'Uploads directory must be writable',
];

foreach ($permissionChecks as $dir => $desc) {
    $path = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $dir);
    $writable = is_writable($path);
    $status = $writable ? '✓' : '⚠';
    echo "   $status $dir ($desc)\n";
    $checks['perm_' . str_replace('/', '_', $dir)] = $writable;
}

// 7. Check PHP Version and Extensions
echo "\n7. PHP Environment:\n";
echo "   PHP Version: " . phpversion() . "\n";
$extensions = ['mysqli', 'pdo', 'pdo_mysql', 'curl', 'mbstring', 'json'];
foreach ($extensions as $ext) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? '✓' : '✗';
    echo "   $status Extension: $ext\n";
    $checks['ext_' . $ext] = $loaded;
}

// 8. Summary
echo "\n8. Summary:\n";
$totalChecks = count($checks);
$passedChecks = array_sum(array_map('intval', $checks));
$percentage = round(($passedChecks / $totalChecks) * 100, 1);

echo "   Total checks: $totalChecks\n";
echo "   Passed: $passedChecks\n";
echo "   Failed: " . ($totalChecks - $passedChecks) . "\n";
echo "   Success rate: $percentage%\n";

// Final Status
echo "\n";
if ($percentage === 100.0) {
    echo "   ✓ Project is fully configured and ready!\n";
    $exitCode = 0;
} elseif ($percentage >= 90) {
    echo "   ⚠ Project is mostly configured. Check failures above.\n";
    $exitCode = 1;
} else {
    echo "   ✗ Project has configuration issues. Fix failures above.\n";
    $exitCode = 1;
}

echo "\n═══════════════════════════════════════════════════════════════\n\n";
exit($exitCode);
?>
