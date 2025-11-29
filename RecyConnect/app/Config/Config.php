<?php
/**
 * RecyConnect - Application Configuration
 * Centralized configuration for the application
 */

namespace App\Config;

class Config {
    // Application Settings
    const APP_NAME = 'RecyConnect';
    const APP_TAGLINE = 'Smart Waste Management';
    const APP_VERSION = '1.0.0';
    
    // Paths (relative to project root)
    const BASE_PATH = __DIR__ . '/../../';
    const PUBLIC_PATH = self::BASE_PATH . 'public/';
    const VIEWS_PATH = self::BASE_PATH . 'views/';
    const APP_PATH = self::BASE_PATH . 'app/';
    
    // URL Configuration
    public static function getBaseUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        
        // Remove 'public' from path if present
        if (strpos($scriptPath, 'public') !== false) {
            $scriptPath = dirname($scriptPath);
        }
        
        $baseUrl = rtrim($scriptPath, '/');
        if ($baseUrl === '' || $baseUrl === '.') {
            $baseUrl = '/';
        } else {
            $baseUrl .= '/';
        }
        
        return $baseUrl;
    }
    
    public static function getPublicUrl() {
        return self::getBaseUrl() . 'public/';
    }
    
    public static function getCssUrl() {
        return self::getPublicUrl() . 'css/';
    }
    
    public static function getJsUrl() {
        return self::getPublicUrl() . 'js/';
    }
    
    public static function getImagesUrl() {
        return self::getPublicUrl() . 'images/';
    }
    
    // Session Configuration
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Get current user from session
    public static function getCurrentUser() {
        self::startSession();
        return $_SESSION['user'] ?? null;
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }
    
    // Set user in session
    public static function setUser($user) {
        self::startSession();
        $_SESSION['user'] = $user;
    }
    
    // Logout
    public static function logout() {
        self::startSession();
        unset($_SESSION['user']);
        session_destroy();
    }
}

