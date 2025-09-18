<?php
// filepath: c:\Users\mark\Documents\WebDesign\Netmatters-Homepage\test_db.php
require_once __DIR__ . '/loadenv.php';

try {
    // Build database connection string
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    
    // Create PDO connection
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    echo "✅ Database connection successful!\n";
    echo "Connected to: {$dbname} on {$host}\n";
    echo "Using username: {$username}\n";
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Make sure XAMPP MySQL is running and the database '{$_ENV['DB_NAME']}' exists.\n";
}