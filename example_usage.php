<?php
/**
 * Example PHP file using the common environment loader
 */

// Include the environment loader
require_once __DIR__ . '/loadenv.php';

// Now you can use environment variables anywhere in this file
echo "Database Configuration:<br>";
echo "Host: " . $_ENV['DB_HOST'] . "<br>";
echo "Database: " . $_ENV['DB_NAME'] . "<br>";
echo "User: " . $_ENV['DB_USER'] . "<br>";

echo "<br>Application Settings:<br>";
echo "Name: " . $_ENV['APP_NAME'] . "<br>";
echo "Version: " . $_ENV['APP_VERSION'] . "<br>";
echo "Environment: " . $_ENV['APP_ENV'] . "<br>";

// Example of using environment variables for database connection
try {
    $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
    // $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    echo "<br>Database DSN: " . $dsn . "<br>";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
}