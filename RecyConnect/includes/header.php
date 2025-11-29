<?php
/**
 * RecyConnect - Header Include
 * Flexible header that works for both public and user pages
 */

// Load config if not already loaded
if (!defined('APP_NAME')) {
    require_once __DIR__ . '/config.php';
}

// Set defaults
$page_title = $page_title ?? APP_NAME . ' - ' . APP_TAGLINE;
$show_sidebar = $show_sidebar ?? true; // For dashboard pages
$is_public = $is_public ?? false; // For landing page
$additional_css = $additional_css ?? [];

// Determine CSS path based on file location
$css_base = (strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? '../css/' : 'css/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $css_base; ?>style.css">
    <?php foreach ($additional_css as $css): ?>
        <link rel="stylesheet" href="<?php echo $css_base . $css; ?>">
    <?php endforeach; ?>
</head>
<body>
    <?php if ($is_public): ?>
        <?php include __DIR__ . '/navbar-public.php'; ?>
    <?php else: ?>
        <?php include __DIR__ . '/navbar-user.php'; ?>
    <?php endif; ?>

    <?php if (!$is_public): ?>
    <div class="container-fluid">
        <div class="row">
    <?php endif; ?>