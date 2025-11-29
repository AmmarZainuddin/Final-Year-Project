<?php
/**
 * RecyConnect - Authentication Controller
 * Handles login, registration, and logout
 */

namespace App\Controllers;

use App\Models\User;
use App\Config\Config;

class AuthController extends BaseController {
    
    /**
     * Show login page
     */
    public function showLogin() {
        // Redirect if already logged in
        if (Config::isLoggedIn()) {
            $this->redirect('dashboard');
        }
        
        $this->view('auth/login', [
            'page_title' => 'Login - ' . Config::APP_NAME,
            'error' => $_GET['error'] ?? null
        ]);
    }
    
    /**
     * Handle login form submission
     */
    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $this->redirect('login?error=' . urlencode('Please fill in all fields.'));
        }
        
        $userModel = new User();
        $user = $userModel->authenticate($email, $password);
        
        if ($user) {
            Config::setUser($user);
            $this->redirect('dashboard');
        } else {
            $this->redirect('login?error=' . urlencode('Invalid email or password.'));
        }
    }
    
    /**
     * Show registration page
     */
    public function showRegister() {
        // Redirect if already logged in
        if (Config::isLoggedIn()) {
            $this->redirect('dashboard');
        }
        
        $this->view('auth/register', [
            'page_title' => 'Sign Up - ' . Config::APP_NAME,
            'error' => $_GET['error'] ?? null
        ]);
    }
    
    /**
     * Handle registration form submission
     */
    public function register() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $phone = trim($_POST['phone'] ?? '');
        $agreeTerms = isset($_POST['agree_terms']);
        
        // Validation
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'Please enter your full name.';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }
        
        if (empty($password) || strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters long.';
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
        }
        
        if (!$agreeTerms) {
            $errors[] = 'Please agree to the terms and conditions.';
        }
        
        if (!empty($errors)) {
            $this->redirect('register?error=' . urlencode(implode(' ', $errors)));
        }
        
        $userModel = new User();
        
        // Check if email already exists
        if ($userModel->emailExists($email)) {
            $this->redirect('register?error=' . urlencode('Email already registered.'));
        }
        
        // Create user
        $userId = $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone
        ]);
        
        if ($userId) {
            // Auto-login after registration
            $user = $userModel->findById($userId);
            Config::setUser($user);
            $this->redirect('dashboard');
        } else {
            $this->redirect('register?error=' . urlencode('Registration failed. Please try again.'));
        }
    }
    
    /**
     * Handle logout
     */
    public function logout() {
        Config::logout();
        $this->redirect('');
    }
}

