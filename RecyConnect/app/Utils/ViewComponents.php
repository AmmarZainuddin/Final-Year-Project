<?php
/**
 * RecyConnect - View Components Utility
 * Reusable UI component functions for views
 */

namespace App\Utils;

class ViewComponents {
    
    /**
     * Render a stat card component
     */
    public function renderStatCard($icon, $title, $value, $change, $type = 'primary') {
        $types = [
            'primary' => 'primary-card',
            'success' => 'success-card',
            'warning' => 'warning-card',
            'info' => 'info-card'
        ];
        
        $card_class = $types[$type] ?? $types['primary'];
        
        return "
        <div class=\"col-xl-3 col-md-6 mb-4\">
            <div class=\"stat-card {$card_class}\">
                <div class=\"stat-icon\">
                    <i class=\"{$icon}\"></i>
                </div>
                <h6>" . htmlspecialchars($title) . "</h6>
                <div class=\"stat-value\">{$value}</div>
                <div class=\"stat-change\">{$change}</div>
            </div>
        </div>";
    }
    
    /**
     * Render activity table row
     */
    public function renderActivityRow($activity) {
        $id = $activity['id'] ?? '';
        $icon = $activity['icon'] ?? 'fas fa-recycle';
        $icon_bg = $activity['icon_bg'] ?? '#e2e8f0';
        $icon_color = $activity['icon_color'] ?? '#64748b';
        $title = htmlspecialchars($activity['title'] ?? '');
        $subtitle = htmlspecialchars($activity['subtitle'] ?? '');
        $date = htmlspecialchars($activity['date'] ?? '');
        $time = htmlspecialchars($activity['time'] ?? '');
        $weight = htmlspecialchars($activity['weight'] ?? '');
        $status = $activity['status'] ?? 'pending';
        $points = $activity['points'] ?? null;
        
        $status_classes = [
            'completed' => 'badge-completed',
            'pending' => 'badge-pending',
            'processing' => 'badge-processing'
        ];
        
        $status_class = $status_classes[$status] ?? 'badge-pending';
        $status_text = ucfirst($status);
        
        $points_html = $points !== null 
            ? "<span class=\"points-badge\">+" . htmlspecialchars($points) . "</span>"
            : "<span class=\"no-points\">--</span>";
        
        return "
        <tr>
            <td><strong>#" . htmlspecialchars($id) . "</strong></td>
            <td>
                <div class=\"d-flex align-items-center\">
                    <span class=\"activity-icon\" style=\"background: {$icon_bg}; color: {$icon_color};\">
                        <i class=\"{$icon}\"></i>
                    </span>
                    <div>
                        <div class=\"activity-title\">{$title}</div>
                        <small class=\"activity-subtitle\">{$subtitle}</small>
                    </div>
                </div>
            </td>
            <td>
                <div class=\"activity-date\">{$date}</div>
                <small class=\"activity-time\">{$time}</small>
            </td>
            <td><strong>{$weight}</strong></td>
            <td><span class=\"badge badge-modern {$status_class}\">{$status_text}</span></td>
            <td>{$points_html}</td>
        </tr>";
    }
    
    /**
     * Render impact item
     */
    public function renderImpactItem($icon, $value, $label) {
        return "
        <div class=\"col-md-4\">
            <div class=\"impact-item\">
                <div class=\"impact-icon\">
                    <i class=\"{$icon}\"></i>
                </div>
                <div class=\"impact-details\">
                    <h5>" . htmlspecialchars($value) . "</h5>
                    <p>" . htmlspecialchars($label) . "</p>
                </div>
            </div>
        </div>";
    }
    
    /**
     * Render feature card
     */
    public function renderFeatureCard($icon, $title, $description) {
        return "
        <div class=\"col-md-6 col-lg-4\">
            <div class=\"feature-card\">
                <div class=\"feature-icon\">
                    <i class=\"{$icon}\"></i>
                </div>
                <h4>" . htmlspecialchars($title) . "</h4>
                <p>" . htmlspecialchars($description) . "</p>
            </div>
        </div>";
    }
    
    /**
     * Render step card
     */
    public function renderStepCard($number, $icon, $title, $description) {
        return "
        <div class=\"col-md-4\">
            <div class=\"step-card\">
                <div class=\"step-number\">{$number}</div>
                <div class=\"step-icon\">
                    <i class=\"{$icon}\"></i>
                </div>
                <h4>" . htmlspecialchars($title) . "</h4>
                <p>" . htmlspecialchars($description) . "</p>
            </div>
        </div>";
    }
}

