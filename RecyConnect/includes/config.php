<?php
/**
 * RecyConnect - Configuration File
 * Centralized configuration for paths, constants, and settings
 */

// Prevent direct access
if (!defined('APP_INIT')) {
    define('APP_INIT', true);
}

// Base URL (adjust based on your server setup)
$script_path = dirname($_SERVER['SCRIPT_NAME']);

// Remove 'includes' from path if we're in includes directory
if (strpos($script_path, 'includes') !== false) {
    $script_path = dirname($script_path);
}

// Remove 'user' from path if we're in user directory
if (strpos($script_path, 'user') !== false) {
    $script_path = dirname($script_path);
}

// Ensure path ends with /
$base_url = rtrim($script_path, '/');
if ($base_url === '' || $base_url === '.') {
    $base_url = '/';
} else {
    $base_url .= '/';
}

define('BASE_URL', $base_url);
define('CSS_PATH', BASE_URL . 'css/');
define('JS_PATH', BASE_URL . 'js/');
define('INCLUDES_PATH', __DIR__);

// Application Settings
define('APP_NAME', 'RecyConnect');
define('APP_TAGLINE', 'Smart Waste Management');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current user from session (when authentication is implemented)
$current_user = $_SESSION['user'] ?? null;
$is_logged_in = isset($_SESSION['user']);

// Helper function to get asset path
function asset_path($path) {
    return BASE_URL . ltrim($path, '/');
}

// Helper function to get CSS path
function css_path($file) {
    return CSS_PATH . ltrim($file, '/');
}

// Helper function to get JS path
function js_path($file) {
    return JS_PATH . ltrim($file, '/');
}

// Helper function to get include path
function include_path($file) {
    return INCLUDES_PATH . '/' . ltrim($file, '/');
}

