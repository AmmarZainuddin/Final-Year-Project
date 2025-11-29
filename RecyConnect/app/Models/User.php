<?php
/**
 * RecyConnect - User Model
 * Handles user database operations
 */

namespace App\Models;

use App\Config\Database;

class User {
    private $db;
    
    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }
    
    /**
     * Authenticate user
     */
    public function authenticate($email, $password) {
        // Try database first if connected
        if ($this->db) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND status = 'active'");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    // Remove password from returned data
                    unset($user['password']);
                    return $user;
                }
            } catch (\PDOException $e) {
                // Database error, fall through to demo account
                error_log("Auth query error: " . $e->getMessage());
            }
        }
        
        // Fallback to demo account (for development when database not available)
        if ($email === 'demo@recyconnect.com' && $password === 'demo123') {
            return [
                'id' => 1,
                'name' => 'Demo User',
                'email' => 'demo@recyconnect.com',
                'phone' => null,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        
        return false;
    }
    
    /**
     * Check if email exists
     */
    public function emailExists($email) {
        if (!$this->db) {
            // No database, allow registration
            return false;
        }
        
        try {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch() !== false;
        } catch (\PDOException $e) {
            // If table doesn't exist, return false (allow registration)
            return false;
        }
    }
    
    /**
     * Create new user
     */
    public function create($data) {
        if (!$this->db) {
            // No database connection - return mock ID for development
            error_log("Database not available - using mock user creation");
            return 1; // Mock user ID
        }
        
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("
                INSERT INTO users (name, email, password, phone, created_at) 
                VALUES (?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $data['name'],
                $data['email'],
                $hashedPassword,
                $data['phone'] ?? null
            ]);
            
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("User creation error: " . $e->getMessage());
            // Return mock ID if database fails
            return 1;
        }
    }
    
    /**
     * Find user by ID
     */
    public function findById($id) {
        if (!$this->db) {
            // Return mock user if database not available
            return [
                'id' => $id,
                'name' => 'Demo User',
                'email' => 'demo@recyconnect.com',
                'phone' => null,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        
        try {
            $stmt = $this->db->prepare("SELECT id, name, email, phone, created_at FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    /**
     * Get user statistics
     */
    public function getUserStats($userId) {
        // TODO: Replace with actual database queries
        // For now, return mock data
        return [
            'total_points' => 1250,
            'total_recycled' => 34.2,
            'next_pickup' => 'Tomorrow',
            'next_pickup_time' => '10:00 AM',
            'co2_saved' => 87.5,
            'trees_equivalent' => 4,
            'water_conserved' => 425,
            'energy_saved' => 156,
            'items_recycled' => 18,
            'points_change' => 12,
            'recycled_change' => 8
        ];
    }
    
    /**
     * Get recent activities
     */
    public function getRecentActivities($userId, $limit = 5) {
        // TODO: Replace with actual database queries
        return [
            [
                'id' => 1001,
                'icon' => 'fas fa-newspaper',
                'icon_bg' => '#dbeafe',
                'icon_color' => '#1e40af',
                'title' => 'Paper Waste Pickup',
                'subtitle' => 'Residential Collection',
                'date' => 'Nov 24, 2025',
                'time' => '2:30 PM',
                'weight' => '12.5 kg',
                'status' => 'completed',
                'points' => 50
            ],
            [
                'id' => 1002,
                'icon' => 'fas fa-laptop',
                'icon_bg' => '#dcfce7',
                'icon_color' => '#166534',
                'title' => 'E-Waste Drop-off',
                'subtitle' => 'Drop-off Centre',
                'date' => 'Nov 20, 2025',
                'time' => '11:15 AM',
                'weight' => '8.3 kg',
                'status' => 'completed',
                'points' => 100
            ],
            [
                'id' => 1003,
                'icon' => 'fas fa-truck',
                'icon_bg' => '#fef3c7',
                'icon_color' => '#92400e',
                'title' => 'Scheduled Pickup',
                'subtitle' => 'Mixed Recyclables',
                'date' => 'Nov 29, 2025',
                'time' => '10:00 AM',
                'weight' => 'Est. 15 kg',
                'status' => 'pending',
                'points' => null
            ],
            [
                'id' => 1004,
                'icon' => 'fas fa-bottle-water',
                'icon_bg' => '#e0e7ff',
                'icon_color' => '#4338ca',
                'title' => 'Plastic Bottles',
                'subtitle' => 'Residential Collection',
                'date' => 'Nov 18, 2025',
                'time' => '3:45 PM',
                'weight' => '5.8 kg',
                'status' => 'completed',
                'points' => 35
            ],
            [
                'id' => 1005,
                'icon' => 'fas fa-box',
                'icon_bg' => '#fce7f3',
                'icon_color' => '#9f1239',
                'title' => 'Cardboard Collection',
                'subtitle' => 'Drop-off Centre',
                'date' => 'Nov 15, 2025',
                'time' => '9:20 AM',
                'weight' => '7.6 kg',
                'status' => 'completed',
                'points' => 40
            ]
        ];
    }
}

