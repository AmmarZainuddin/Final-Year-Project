<?php
/**
 * RecyConnect - User Dashboard View
 */

use App\Utils\ViewComponents;

$components = new ViewComponents();
?>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h1><i class="fas fa-chart-line me-2"></i>Welcome back, <?php echo htmlspecialchars($user['name'] ?? 'User'); ?>!</h1>
    <p>Here's your recycling impact overview for this month</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <?php 
    echo $components->renderStatCard(
        'fas fa-coins',
        'Total Points',
        number_format($stats['total_points']),
        '<i class="fas fa-arrow-up me-1"></i>' . $stats['points_change'] . '% from last month',
        'primary'
    );
    
    echo $components->renderStatCard(
        'fas fa-weight-hanging',
        'Total Recycled',
        $stats['total_recycled'] . ' <span class="stat-unit">kg</span>',
        '<i class="fas fa-arrow-up me-1"></i>' . $stats['recycled_change'] . '% from last month',
        'success'
    );
    
    echo $components->renderStatCard(
        'fas fa-calendar-check',
        'Next Pickup',
        '<span class="stat-value-large">' . htmlspecialchars($stats['next_pickup']) . '</span>',
        '<span class="stat-change-warning"><i class="fas fa-clock me-1"></i>' . htmlspecialchars($stats['next_pickup_time']) . '</span>',
        'warning'
    );
    
    echo $components->renderStatCard(
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
        echo $components->renderImpactItem('fas fa-water', $stats['water_conserved'] . ' L', 'Water Conserved');
        echo $components->renderImpactItem('fas fa-bolt', $stats['energy_saved'] . ' kWh', 'Energy Saved');
        echo $components->renderImpactItem('fas fa-recycle', $stats['items_recycled'] . ' Items', 'Recycled This Month');
        ?>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h4 class="section-title">
        <i class="fas fa-bolt"></i>Quick Actions
    </h4>
    <div class="d-flex flex-wrap gap-3">
        <a href="<?php echo $baseUrl; ?>schedule" class="action-btn">
            <i class="fas fa-truck-pickup"></i> Schedule Pickup
        </a>
        <a href="<?php echo $baseUrl; ?>map" class="action-btn secondary">
            <i class="fas fa-map-marker-alt"></i> Find Nearest Centre
        </a>
        <a href="<?php echo $baseUrl; ?>giveaway" class="action-btn giveaway">
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
                    <?php echo $components->renderActivityRow($activity); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

