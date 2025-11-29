<?php
/**
 * RecyConnect - Public Navbar Component
 * Navigation bar for public/landing pages
 */

use App\Config\Config;

$baseUrl = Config::getBaseUrl();
$appName = Config::APP_NAME;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $baseUrl; ?>">
            <i class="fa-solid fa-recycle"></i> <?php echo $appName; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#how-it-works">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#impact">Impact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light text-success ms-2 px-3" href="<?php echo $baseUrl; ?>register">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
