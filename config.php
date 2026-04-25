<?php
// config.php
// Database and application configuration

session_start();

// Database file path
define('DB_FILE', __DIR__ . '/data/poultry.db');

// Base URL (adjust if using a subdirectory)
define('BASE_URL', '/Techfeathers');

// Ensure data directory exists
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0755, true);
}

// Create DB connection
function get_db() {
    static $db;
    if (!$db) {
        $db = new PDO('sqlite:' . DB_FILE);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $db;
}

// Initialize the database if it does not exist
if (!file_exists(DB_FILE)) {
    require_once __DIR__ . '/init_db.php';
}
