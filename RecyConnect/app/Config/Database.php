<?php
/**
 * RecyConnect - Database Configuration
 * Handles database connection and configuration
 */

namespace App\Config;

class Database {
    private static $instance = null;
    private $connection = null;
    private $connected = false;
    
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    
    private function __construct() {
        // Load environment variables (fallback to defaults)
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->dbname = $_ENV['DB_NAME'] ?? 'recyconnect';
        $this->username = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASS'] ?? '';
        $this->charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';
    }
    
    private function connect() {
        if ($this->connected && $this->connection !== null) {
            return $this->connection;
        }
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->connection = new \PDO($dsn, $this->username, $this->password, $options);
            $this->connected = true;
            return $this->connection;
        } catch (\PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            $this->connected = false;
            $this->connection = null;
            // Don't throw exception - allow app to work without database
            return null;
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        if ($this->connection === null) {
            $this->connect();
        }
        return $this->connection;
    }
    
    public function isConnected() {
        return $this->connected && $this->connection !== null;
    }
    
    // Prevent cloning
    private function __clone() {}
    
    // Prevent unserialization
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
}

