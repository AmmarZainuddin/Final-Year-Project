<?php
/**
 * RecyConnect - Base Controller
 * Base class for all controllers
 */

namespace App\Controllers;

use App\Config\Config;

abstract class BaseController {
    protected $config;
    
    public function __construct() {
        $this->config = Config::class;
    }
    
    /**
     * Render a view
     */
    protected function view($viewPath, $data = []) {
        // Extract data array to variables
        extract($data);
        
        // Set default variables available in all views
        $baseUrl = Config::getBaseUrl();
        $publicUrl = Config::getPublicUrl();
        $cssUrl = Config::getCssUrl();
        $jsUrl = Config::getJsUrl();
        $currentUser = Config::getCurrentUser();
        $isLoggedIn = Config::isLoggedIn();
        
        // Include header layout
        require Config::VIEWS_PATH . 'layouts/header.php';
        
        // Include sidebar if needed
        if (!$is_public && $show_sidebar) {
            require Config::VIEWS_PATH . 'layouts/sidebar.php';
        }
        
        // Include the view file
        $viewFile = Config::VIEWS_PATH . $viewPath . '.php';
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View not found: {$viewPath}");
        }
        
        require $viewFile;
        
        // Include footer layout
        require Config::VIEWS_PATH . 'layouts/footer.php';
    }
    
    /**
     * Redirect to a URL
     */
    protected function redirect($url) {
        header("Location: " . Config::getBaseUrl() . ltrim($url, '/'));
        exit;
    }
    
    /**
     * Return JSON response
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Check if user is authenticated
     */
    protected function requireAuth() {
        if (!Config::isLoggedIn()) {
            $this->redirect('login');
        }
    }
}

