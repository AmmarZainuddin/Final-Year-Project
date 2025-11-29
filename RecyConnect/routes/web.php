<?php
/**
 * RecyConnect - Web Routes
 * Define all application routes here
 */

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PickupController;
use App\Controllers\MapController;

// Helper function to define routes
function route($method, $path, $controller, $action) {
    return [
        'method' => $method,
        'path' => $path,
        'controller' => $controller,
        'action' => $action
    ];
}

// Define routes
$routes = [
    // Public Routes
    route('GET', '/', 'HomeController', 'index'),
    route('GET', '/login', 'AuthController', 'showLogin'),
    route('POST', '/login', 'AuthController', 'login'),
    route('GET', '/register', 'AuthController', 'showRegister'),
    route('POST', '/register', 'AuthController', 'register'),
    route('GET', '/logout', 'AuthController', 'logout'),
    
    // User Routes (require authentication)
    route('GET', '/dashboard', 'DashboardController', 'index'),
    route('GET', '/schedule', 'PickupController', 'schedule'),
    route('POST', '/schedule', 'PickupController', 'create'),
    route('GET', '/map', 'MapController', 'index'),
    route('GET', '/giveaway', 'GiveawayController', 'index'),
    route('GET', '/rewards', 'RewardsController', 'index'),
    route('GET', '/education', 'EducationController', 'index'),
    
    // Admin Routes (require admin authentication)
    route('GET', '/admin/dashboard', 'AdminController', 'dashboard'),
];

return $routes;

