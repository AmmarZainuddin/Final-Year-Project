<?php
/**
 * RecyConnect - Map Controller
 * Handles recycling center locations
 */

namespace App\Controllers;

use App\Models\RecyclingCentre;
use App\Config\Config;

class MapController extends BaseController {
    
    /**
     * Show map page with recycling centers
     */
    public function index() {
        $this->requireAuth();
        
        $centreModel = new RecyclingCentre();
        $centres = $centreModel->getAll();
        
        $this->view('user/map', [
            'page_title' => 'Find Recycling Centres - ' . Config::APP_NAME,
            'centres' => $centres,
            'show_sidebar' => true
        ]);
    }
}

