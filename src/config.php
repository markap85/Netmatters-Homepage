<?php

require_once realpath(__DIR__ . "/../vendor/autoload.php");

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Access environment variables using $_ENV or getenv()
echo "Database Host: " . $_ENV['DB_HOST'] . "\n";
echo "Database Name: " . $_ENV['DB_NAME'] . "\n";
echo "App Environment: " . $_ENV['APP_ENV'] . "\n";
echo "Debug Mode: " . ($_ENV['APP_DEBUG'] === 'true' ? 'Enabled' : 'Disabled') . "\n";

// Use getenv()
echo "API Key: " . getenv('API_KEY') . "\n";