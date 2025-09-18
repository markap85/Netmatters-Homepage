<?php
/**
 * Environment Loader
 * Include this file in any PHP script that needs to access environment variables
 */

require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Optional: Validate required environment variables
$required = ['DB_HOST', 'DB_NAME', 'APP_ENV'];
$dotenv->required($required);

// Optional: Set default values
if (!isset($_ENV['APP_NAME'])) {
    $_ENV['APP_NAME'] = 'Default App Name';
}