<?php
/**
 * RecyConnect - Recycling Centre Model
 * Handles recycling centre database operations
 */

namespace App\Models;

use App\Config\Database;

class RecyclingCentre {
    private $db;
    
    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }
    
    /**
     * Get all recycling centres
     */
    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM recycling_centres WHERE status = 'active' ORDER BY name");
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            // Return mock data if table doesn't exist
            return [
                [
                    'id' => 1,
                    'name' => 'Green Recycling Centre',
                    'address' => '123 Eco Street, City',
                    'latitude' => 3.1390,
                    'longitude' => 101.6869,
                    'phone' => '+60 3-1234 5678',
                    'hours' => 'Mon-Sat: 9AM-6PM'
                ],
                [
                    'id' => 2,
                    'name' => 'Sustainable Waste Hub',
                    'address' => '456 Green Avenue, City',
                    'latitude' => 3.1490,
                    'longitude' => 101.6969,
                    'phone' => '+60 3-2345 6789',
                    'hours' => 'Mon-Fri: 8AM-5PM'
                ]
            ];
        }
    }
    
    /**
     * Find centre by ID
     */
    public function findById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM recycling_centres WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (\PDOException $e) {
            return false;
        }
    }
}

