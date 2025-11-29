<?php
/**
 * RecyConnect - Home Controller
 * Handles landing page
 */

namespace App\Controllers;

use App\Config\Config;
use App\Utils\ViewComponents;

class HomeController extends BaseController {
    
    /**
     * Show landing page
     */
    public function index() {
        $components = new ViewComponents();
        
        $features = [
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
        
        $steps = [
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
        
        $this->view('home/index', [
            'page_title' => Config::APP_NAME . ' - Smart Waste Management | Transform Your Recycling Journey',
            'is_public' => true,
            'additional_css' => ['landing.css'],
            'additional_js' => ['landing.js'],
            'features' => $features,
            'steps' => $steps,
            'components' => $components
        ]);
    }
}

