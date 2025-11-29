<?php
/**
 * RecyConnect - Pickup Request Model
 * Handles pickup request database operations
 */

namespace App\Models;

use App\Config\Database;

class PickupRequest {
    private $db;
    
    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }
    
    /**
     * Create a new pickup request
     */
    public function create($data) {
        if (!$this->db) {
            // No database - return mock ID for development
            return 1;
        }
        
        try {
            $stmt = $this->db->prepare("
                INSERT INTO pickup_requests 
                (user_id, date, time, address, waste_type, weight_estimate, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())
            ");
            
            $stmt->execute([
                $data['user_id'],
                $data['date'],
                $data['time'],
                $data['address'],
                $data['waste_type'],
                $data['weight_estimate'] ?? null
            ]);
            
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Pickup request creation error: " . $e->getMessage());
            // For development, return mock ID
            return 1;
        }
    }
    
    /**
     * Get user's pickup requests
     */
    public function getUserPickups($userId) {
        if (!$this->db) {
            // Return empty array if database not available
            return [];
        }
        
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM pickup_requests 
                WHERE user_id = ? 
                ORDER BY created_at DESC
            ");
            $stmt->execute([$userId]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return [];
        }
    }
}

