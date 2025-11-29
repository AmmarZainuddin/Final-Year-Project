<?php
/**
 * RecyConnect - User Navbar Component
 * Navigation bar for authenticated user pages
 */

use App\Config\Config;

$currentUser = Config::getCurrentUser();
$user_name = $currentUser['name'] ?? 'User';
$show_sidebar = $show_sidebar ?? false;
$baseUrl = Config::getBaseUrl();
$appName = Config::APP_NAME;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <?php if ($show_sidebar): ?>
            <button class="btn btn-link text-white sidebar-toggle" id="sidebarToggle" type="button">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        <?php endif; ?>
        <a class="navbar-brand" href="<?php echo $baseUrl; ?>dashboard">
            <i class="fa-solid fa-recycle"></i> <?php echo $appName; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-bell"></i> Notifications</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle"></i> <?php echo htmlspecialchars($user_name); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?php echo $baseUrl; ?>logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
