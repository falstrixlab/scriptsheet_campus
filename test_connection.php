<?php
/**
 * Test Database Connection
 */
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $db = \Config\Database::connect();
    echo "✓ Database connection successful!\n";
    echo "Host: " . $db->getHostname() . "\n";
    echo "Database: " . $db->getDatabase() . "\n";
    echo "Driver: " . $db->DBDriver . "\n";
    
    // List tables
    $tables = $db->listTables();
    echo "\nTables in database (" . count($tables) . "):\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
} catch (\Exception $e) {
    echo "✗ Database connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
