<?php
/**
 * RecyConnect - Environment Configuration Loader
 * Loads environment variables from .env file
 */

namespace App\Config;

class Env {
    private static $loaded = false;
    
    public static function load($path = null) {
        if (self::$loaded) {
            return;
        }
        
        if ($path === null) {
            $path = __DIR__ . '/../../.env';
        }
        
        if (!file_exists($path)) {
            // If .env doesn't exist, use .env.example or set defaults
            $examplePath = __DIR__ . '/../../.env.example';
            if (file_exists($examplePath)) {
                $path = $examplePath;
            } else {
                // Set default environment variables
                $_ENV['DB_HOST'] = 'localhost';
                $_ENV['DB_NAME'] = 'recyconnect';
                $_ENV['DB_USER'] = 'root';
                $_ENV['DB_PASS'] = '';
                $_ENV['DB_CHARSET'] = 'utf8mb4';
                $_ENV['APP_ENV'] = 'development';
                $_ENV['APP_DEBUG'] = 'true';
                self::$loaded = true;
                return;
            }
        }
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Parse KEY=VALUE
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes if present
                $value = trim($value, '"\'');
                
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
        
        self::$loaded = true;
    }
}

