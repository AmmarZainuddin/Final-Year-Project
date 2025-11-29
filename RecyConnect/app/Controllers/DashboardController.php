<?php
/**
 * RecyConnect - Dashboard Controller
 * Handles user dashboard and statistics
 */

namespace App\Controllers;

use App\Models\User;
use App\Config\Config;
use App\Utils\ViewComponents;

class DashboardController extends BaseController {
    
    /**
     * Show user dashboard
     */
    public function index() {
        $this->requireAuth();
        
        $userModel = new User();
        $currentUser = Config::getCurrentUser();
        $components = new ViewComponents();
        
        // Get user statistics
        $stats = $userModel->getUserStats($currentUser['id']);
        
        // Get recent activities
        $activities = $userModel->getRecentActivities($currentUser['id'], 5);
        
        $this->view('user/dashboard', [
            'page_title' => 'Dashboard - ' . Config::APP_NAME,
            'user' => $currentUser,
            'stats' => $stats,
            'activities' => $activities,
            'show_sidebar' => true,
            'additional_css' => ['dashboard.css'],
            'components' => $components
        ]);
    }
}

