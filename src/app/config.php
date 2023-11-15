<?php

// Show all errors for development purposes
// Remove this for the deployment builds
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Database connection-settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'website');

date_default_timezone_set('Europe/Brussels');

// Console log helper function
function debugToConsole($output) {
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('$output');</script>";
}

// Connect with the database
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "An error occurred while trying to connect to the database: " . $e->getMessage();
    exit;
}

?>
