<?php
/**
 * RecyConnect - Point Calculator Utility
 * Calculates reward points based on recycling activities
 */

namespace App\Utils;

class PointCalculator {
    // Point rates per kg
    const POINTS_PER_KG_PAPER = 4;
    const POINTS_PER_KG_PLASTIC = 5;
    const POINTS_PER_KG_GLASS = 3;
    const POINTS_PER_KG_METAL = 6;
    const POINTS_PER_KG_ELECTRONICS = 10;
    const POINTS_PER_KG_MIXED = 4;
    
    /**
     * Calculate points for a recycling activity
     */
    public static function calculate($wasteType, $weight) {
        $rate = self::getRateForType($wasteType);
        return (int)($weight * $rate);
    }
    
    /**
     * Get point rate for waste type
     */
    private static function getRateForType($type) {
        $rates = [
            'paper' => self::POINTS_PER_KG_PAPER,
            'plastic' => self::POINTS_PER_KG_PLASTIC,
            'glass' => self::POINTS_PER_KG_GLASS,
            'metal' => self::POINTS_PER_KG_METAL,
            'electronics' => self::POINTS_PER_KG_ELECTRONICS,
            'mixed' => self::POINTS_PER_KG_MIXED
        ];
        
        return $rates[strtolower($type)] ?? self::POINTS_PER_KG_MIXED;
    }
    
    /**
     * Calculate environmental impact
     */
    public static function calculateImpact($wasteType, $weight) {
        // CO2 saved per kg (approximate)
        $co2Rates = [
            'paper' => 1.5,
            'plastic' => 2.0,
            'glass' => 0.5,
            'metal' => 2.5,
            'electronics' => 3.0,
            'mixed' => 1.5
        ];
        
        $co2Saved = $weight * ($co2Rates[strtolower($wasteType)] ?? 1.5);
        
        return [
            'co2_saved' => round($co2Saved, 2),
            'water_saved' => round($weight * 25, 2), // liters
            'energy_saved' => round($weight * 4.5, 2) // kWh
        ];
    }
}

