<?php
/**
 * RecyConnect - Registration View
 */

use App\Config\Config;
?>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <h2 class="auth-title">Create Your Account</h2>
                        <p class="auth-subtitle">Join <?php echo Config::APP_NAME; ?> and start your recycling journey</p>
                    </div>

                    <?php if (isset($error) && $error): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo $baseUrl; ?>register" class="auth-form" id="signupForm">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2"></i>Full Name
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Enter your full name"
                                    value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                    required
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                placeholder="Enter your email"
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone me-2"></i>Phone Number
                            </label>
                            <input 
                                type="tel" 
                                class="form-control" 
                                id="phone" 
                                name="phone" 
                                placeholder="Enter your phone number"
                                value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                            >
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="password-input-wrapper">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Create password"
                                        required
                                        minlength="6"
                                    >
                                    <button type="button" class="password-toggle" id="togglePassword">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Minimum 6 characters</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Confirm Password
                                </label>
                                <div class="password-input-wrapper">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="confirm_password" 
                                        name="confirm_password" 
                                        placeholder="Confirm password"
                                        required
                                        minlength="6"
                                    >
                                    <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                        <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                <label class="form-check-label" for="agree_terms">
                                    I agree to the <a href="<?php echo $baseUrl; ?>terms" target="_blank">Terms and Conditions</a> and <a href="<?php echo $baseUrl; ?>privacy" target="_blank">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-auth btn-primary w-100 mb-3">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>

                        <div class="auth-divider">
                            <span>or</span>
                        </div>

                        <div class="text-center">
                            <p class="auth-footer-text">
                                Already have an account? 
                                <a href="<?php echo $baseUrl; ?>login" class="auth-link">Sign in here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$additional_css = ['auth.css'];
$additional_js = ['auth.js'];
?>

