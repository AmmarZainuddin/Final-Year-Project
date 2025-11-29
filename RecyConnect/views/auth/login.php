<?php
/**
 * RecyConnect - Login View
 */

use App\Config\Config;
?>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-icon">
                            <i class="fa-solid fa-recycle"></i>
                        </div>
                        <h2 class="auth-title">Welcome Back</h2>
                        <p class="auth-subtitle">Sign in to continue to <?php echo Config::APP_NAME; ?></p>
                    </div>

                    <?php if (isset($error) && $error): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo $baseUrl; ?>login" class="auth-form">
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
                                autofocus
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="password-input-wrapper">
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Enter your password"
                                    required
                                >
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="<?php echo $baseUrl; ?>forgot-password" class="forgot-link">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-auth btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>

                        <div class="auth-divider">
                            <span>or</span>
                        </div>

                        <div class="text-center">
                            <p class="auth-footer-text">
                                Don't have an account? 
                                <a href="<?php echo $baseUrl; ?>register" class="auth-link">Sign up here</a>
                            </p>
                        </div>
                    </form>

                    <div class="auth-demo-info mt-4">
                        <div class="alert alert-info mb-0">
                            <small>
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Demo Account:</strong> demo@recyconnect.com / demo123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$additional_css = ['auth.css'];
$additional_js = ['auth.js'];
?>

