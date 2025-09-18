<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Example usage as shown in the article
$appName = $_ENV['APP_NAME'] ?? 'Netmatters Homepage';
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];

echo "App Name: " . $appName . "<br>";
echo "Database Host: " . $dbHost . "<br>";
echo "Database Name: " . $dbName . "<br>";
echo "Environment: " . $_ENV['APP_ENV'] . "<br>";

// The article recommends using $_ENV over getenv() for security reasons
echo "Debug Mode: " . ($_ENV['APP_DEBUG'] === 'true' ? 'Enabled' : 'Disabled') . "<br>";