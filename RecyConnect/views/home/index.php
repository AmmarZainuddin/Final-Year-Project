<?php
/**
 * RecyConnect - Landing Page View
 */

use App\Config\Config;
use App\Utils\ViewComponents;

$components = $components ?? new ViewComponents();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Transform Your Recycling Journey
                        <span class="text-success">Into Rewards</span>
                    </h1>
                    <p class="hero-subtitle">
                        Join RecyConnect and make a real impact on the environment while earning points for every recycling action. Track your progress, schedule pickups, and contribute to a sustainable future.
                    </p>
                    <div class="hero-buttons">
                        <a href="<?php echo $baseUrl; ?>register" class="btn btn-hero btn-primary me-3">
                            <i class="fas fa-user-plus me-2"></i>Get Started Free
                        </a>
                        <a href="<?php echo $baseUrl; ?>login" class="btn btn-hero btn-outline">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                    <div class="hero-stats mt-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number">10K+</h3>
                                    <p class="stat-label">Active Users</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number">50K+</h3>
                                    <p class="stat-label">Kg Recycled</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number">100K+</h3>
                                    <p class="stat-label">Points Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <div class="floating-card card-1">
                        <i class="fas fa-coins"></i>
                        <p>Earn Points</p>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-recycle"></i>
                        <p>Track Impact</p>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-leaf"></i>
                        <p>Save Planet</p>
                    </div>
                    <div class="hero-icon-main">
                        <i class="fa-solid fa-recycle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose RecyConnect?</h2>
            <p class="section-subtitle">Everything you need to make recycling easy and rewarding</p>
        </div>
        <div class="row g-4">
            <?php foreach ($features as $feature): ?>
                <?php echo $components->renderFeatureCard($feature['icon'], $feature['title'], $feature['description']); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Get started in three simple steps</p>
        </div>
        <div class="row g-4">
            <?php foreach ($steps as $step): ?>
                <?php echo $components->renderStepCard($step['number'], $step['icon'], $step['title'], $step['description']); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Impact Section -->
<section id="impact" class="impact-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title text-white">Your Impact Matters</h2>
                <p class="text-white mb-4 impact-intro">
                    Every recycling action contributes to a healthier planet. Track your environmental impact and see the real difference you're making.
                </p>
                <div class="impact-list">
                    <div class="impact-list-item">
                        <i class="fas fa-water"></i>
                        <div>
                            <h5>Water Conservation</h5>
                            <p>Save thousands of liters of water through recycling</p>
                        </div>
                    </div>
                    <div class="impact-list-item">
                        <i class="fas fa-bolt"></i>
                        <div>
                            <h5>Energy Savings</h5>
                            <p>Reduce energy consumption and carbon footprint</p>
                        </div>
                    </div>
                    <div class="impact-list-item">
                        <i class="fas fa-tree"></i>
                        <div>
                            <h5>Carbon Reduction</h5>
                            <p>Equivalent to planting trees and reducing CO₂ emissions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="impact-visual">
                    <div class="impact-card">
                        <i class="fas fa-globe-americas"></i>
                        <h3>Join the Movement</h3>
                        <p>Be part of a community dedicated to sustainability</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="cta-card">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Ready to Make a Difference?</h2>
                    <p class="cta-subtitle">Join thousands of users who are already making an impact. Start your recycling journey today!</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="<?php echo $baseUrl; ?>register" class="btn btn-cta btn-primary me-2 mb-2 mb-lg-0">
                        <i class="fas fa-rocket me-2"></i>Get Started
                    </a>
                    <a href="<?php echo $baseUrl; ?>login" class="btn btn-cta btn-outline">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fa-solid fa-recycle"></i> <?php echo Config::APP_NAME; ?></h5>
                <p class="mb-0"><?php echo Config::APP_TAGLINE; ?> for a Sustainable Future</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo Config::APP_NAME; ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

