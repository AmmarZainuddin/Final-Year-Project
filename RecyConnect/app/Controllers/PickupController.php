<?php
/**
 * RecyConnect - Pickup Controller
 * Handles pickup scheduling
 */

namespace App\Controllers;

use App\Models\PickupRequest;
use App\Config\Config;

class PickupController extends BaseController {
    
    /**
     * Show schedule pickup page
     */
    public function schedule() {
        $this->requireAuth();
        
        $this->view('user/schedule', [
            'page_title' => 'Schedule Pickup - ' . Config::APP_NAME,
            'show_sidebar' => true
        ]);
    }
    
    /**
     * Create a new pickup request
     */
    public function create() {
        $this->requireAuth();
        
        $currentUser = Config::getCurrentUser();
        
        $pickupModel = new PickupRequest();
        $result = $pickupModel->create([
            'user_id' => $currentUser['id'],
            'date' => $_POST['date'] ?? '',
            'time' => $_POST['time'] ?? '',
            'address' => $_POST['address'] ?? '',
            'waste_type' => $_POST['waste_type'] ?? '',
            'weight_estimate' => $_POST['weight_estimate'] ?? ''
        ]);
        
        if ($result) {
            $this->redirect('dashboard?success=' . urlencode('Pickup scheduled successfully!'));
        } else {
            $this->redirect('schedule?error=' . urlencode('Failed to schedule pickup. Please try again.'));
        }
    }
}

