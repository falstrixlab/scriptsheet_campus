<?php
// Simple DB connection test using credentials from .env
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_alto';
$port = 3306;

$mysqli = @new mysqli($host, $user, $pass, $db, $port);
if ($mysqli->connect_errno) {
    echo "FAILED\n";
    echo "Error ({$mysqli->connect_errno}): {$mysqli->connect_error}\n";
    exit(1);
}

echo "OK\n";
echo "Server info: " . $mysqli->server_info . "\n";
$mysqli->close();
return 0;
