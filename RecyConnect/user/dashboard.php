<?php
/**
 * RecyConnect - User Dashboard
 * Main dashboard page for authenticated users
 */

// Load required files
require_once '../includes/config.php';
require_once '../includes/components.php';
require_once '../includes/data.php';

// Page configuration
$page_title = 'Dashboard - ' . APP_NAME;
$show_sidebar = true;
$additional_css = ['dashboard.css'];

// Include header
include '../includes/header.php';
include '../includes/sidebar.php';

// Get user data
$user_name = $current_user['name'] ?? 'User';
$stats = get_user_stats();
$activities = get_recent_activities();
?>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h1><i class="fas fa-chart-line me-2"></i>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</h1>
    <p>Here's your recycling impact overview for this month</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <?php 
    echo render_stat_card(
        'fas fa-coins',
        'Total Points',
        number_format($stats['total_points']),
        '<i class="fas fa-arrow-up me-1"></i>' . $stats['points_change'] . '% from last month',
        'primary'
    );
    
    echo render_stat_card(
        'fas fa-weight-hanging',
        'Total Recycled',
        $stats['total_recycled'] . ' <span class="stat-unit">kg</span>',
        '<i class="fas fa-arrow-up me-1"></i>' . $stats['recycled_change'] . '% from last month',
        'success'
    );
    
    echo render_stat_card(
        'fas fa-calendar-check',
        'Next Pickup',
        '<span class="stat-value-large">' . htmlspecialchars($stats['next_pickup']) . '</span>',
        '<span class="stat-change-warning"><i class="fas fa-clock me-1"></i>' . htmlspecialchars($stats['next_pickup_time']) . '</span>',
        'warning'
    );
    
    echo render_stat_card(
        'fas fa-leaf',
        'CO₂ Saved',
        $stats['co2_saved'] . ' <span class="stat-unit">kg</span>',
        '<i class="fas fa-tree me-1"></i>≈ ' . $stats['trees_equivalent'] . ' trees planted',
        'info'
    );
    ?>
</div>

<!-- Environmental Impact Summary -->
<div class="impact-summary">
    <h4 class="mb-4"><i class="fas fa-globe-americas me-2"></i>Your Environmental Impact</h4>
    <div class="row">
        <?php
        echo render_impact_item('fas fa-water', $stats['water_conserved'] . ' L', 'Water Conserved');
        echo render_impact_item('fas fa-bolt', $stats['energy_saved'] . ' kWh', 'Energy Saved');
        echo render_impact_item('fas fa-recycle', $stats['items_recycled'] . ' Items', 'Recycled This Month');
        ?>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h4 class="section-title">
        <i class="fas fa-bolt"></i>Quick Actions
    </h4>
    <div class="d-flex flex-wrap gap-3">
        <a href="schedule.php" class="action-btn">
            <i class="fas fa-truck-pickup"></i> Schedule Pickup
        </a>
        <a href="map.php" class="action-btn secondary">
            <i class="fas fa-map-marker-alt"></i> Find Nearest Centre
        </a>
        <a href="giveaway.php" class="action-btn giveaway">
            <i class="fas fa-gift"></i> Browse Giveaways
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="activity-card">
    <h4 class="section-title">
        <i class="fas fa-history"></i>Recent Activity
    </h4>
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Weight</th>
                    <th>Status</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <?php echo render_activity_row($activity); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
