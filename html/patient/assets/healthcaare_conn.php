<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
# Updated for hosting compatibility

// Try to get database credentials from environment variables first (for hosting services)
$hostname_healthcaare_conn = getenv('DB_HOST') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_HOST) : 'localhost');
$username_healthcaare_conn = getenv('DB_USER') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_USER) : 'root');
$password_healthcaare_conn = getenv('DB_PASS') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_PASS) : '');
$database_healthcaare_conn = getenv('DB_NAME') ?: (getenv('DATABASE_URL') ? ltrim(parse_url(getenv('DATABASE_URL'), PHP_URL_PATH), '/') : 'db_healthcare');
$port_healthcaare_conn = getenv('DB_PORT') ?: (getenv('DATABASE_URL') ? parse_url(getenv('DATABASE_URL'), PHP_URL_PORT) : 3306);

// For Railway and other services that provide DATABASE_URL
if (getenv('DATABASE_URL')) {
    $database_url = parse_url(getenv('DATABASE_URL'));
    $hostname_healthcaare_conn = $database_url['host'];
    $username_healthcaare_conn = $database_url['user'];
    $password_healthcaare_conn = $database_url['pass'];
    $database_healthcaare_conn = ltrim($database_url['path'], '/');
    $port_healthcaare_conn = $database_url['port'] ?? 3306;
}

$healthcaare_conn = mysqli_connect($hostname_healthcaare_conn, $username_healthcaare_conn, $password_healthcaare_conn, $database_healthcaare_conn, $port_healthcaare_conn) or trigger_error(mysqli_connect_error(),E_USER_ERROR); 

// Set charset to UTF-8 for better compatibility
mysqli_set_charset($healthcaare_conn, "utf8");
?>

