<?php
/**
 * RecyConnect - Data Layer
 * Functions to retrieve and format data
 */

/**
 * Get user statistics
 * 
 * @param int|null $user_id User ID (null for current user)
 * @return array Statistics array
 */
function get_user_stats($user_id = null) {
    // TODO: Replace with database query
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
 * 
 * @param int|null $user_id User ID
 * @param int $limit Number of activities to return
 * @return array Activities array
 */
function get_recent_activities($user_id = null, $limit = 5) {
    // TODO: Replace with database query
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

/**
 * Get features data for landing page
 * 
 * @return array Features array
 */
function get_features() {
    return [
        [
            'icon' => 'fas fa-coins',
            'title' => 'Earn Rewards',
            'description' => 'Get points for every recycling action. Redeem points for exciting rewards and giveaways.'
        ],
        [
            'icon' => 'fas fa-truck-pickup',
            'title' => 'Easy Pickup',
            'description' => 'Schedule convenient waste pickups from your home. Track your pickup status in real-time.'
        ],
        [
            'icon' => 'fas fa-chart-line',
            'title' => 'Track Progress',
            'description' => 'Monitor your recycling impact with detailed statistics and environmental metrics.'
        ],
        [
            'icon' => 'fas fa-map-marker-alt',
            'title' => 'Find Centers',
            'description' => 'Locate the nearest recycling centers and drop-off points in your area.'
        ],
        [
            'icon' => 'fas fa-leaf',
            'title' => 'Environmental Impact',
            'description' => 'See how much CO₂, water, and energy you\'ve saved through your recycling efforts.'
        ],
        [
            'icon' => 'fas fa-gift',
            'title' => 'Exclusive Giveaways',
            'description' => 'Access special giveaways and discounts available only to RecyConnect members.'
        ]
    ];
}

/**
 * Get steps data for landing page
 * 
 * @return array Steps array
 */
function get_steps() {
    return [
        [
            'number' => 1,
            'icon' => 'fas fa-user-plus',
            'title' => 'Create Account',
            'description' => 'Sign up for free and complete your profile. It only takes a few minutes!'
        ],
        [
            'number' => 2,
            'icon' => 'fas fa-recycle',
            'title' => 'Start Recycling',
            'description' => 'Schedule a pickup or drop off your recyclables at a nearby center.'
        ],
        [
            'number' => 3,
            'icon' => 'fas fa-trophy',
            'title' => 'Earn & Redeem',
            'description' => 'Earn points for your efforts and redeem them for amazing rewards!'
        ]
    ];
}

