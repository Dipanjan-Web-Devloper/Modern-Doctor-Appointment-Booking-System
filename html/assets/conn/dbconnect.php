<?php
// Database configuration for hosting compatibility
// This file supports both local development and free hosting services

// Try to get database credentials from environment variables first (for hosting services)
$db_host = getenv('DB_HOST') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_HOST) : 'localhost');
$db_user = getenv('DB_USER') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_USER) : 'root');
$db_pass = getenv('DB_PASS') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_PASS) : '');
$db_name = getenv('DB_NAME') ?: (getenv('DATABASE_URL') ? ltrim(parse_url(getenv('DATABASE_URL'), PHP_URL_PATH), '/') : 'db_healthcare');
$db_port = getenv('DB_PORT') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_PORT) : 3306);

// For Railway and other services that provide DATABASE_URL
if (getenv('DATABASE_URL')) {
    $database_url = parse_url(getenv('DATABASE_URL'));
    $db_host = $database_url['host'];
    $db_user = $database_url['user'];
    $db_pass = $database_url['pass'];
    $db_name = ltrim($database_url['path'], '/');
    $db_port = $database_url['port'] ?? 3306;
}

// Create connection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Set charset to UTF-8 for better compatibility
mysqli_set_charset($con, "utf8");
?>

