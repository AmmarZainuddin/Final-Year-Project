<?php
/**
 * RecyConnect - Footer Include
 * Flexible footer that works for both public and user pages
 */

// Determine JS path based on file location
$js_base = (strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? '../js/' : 'js/';
$additional_js = $additional_js ?? [];
?>

<?php if (!$is_public): ?>
    </main>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php if (!$is_public && $show_sidebar): ?>
    <script src="<?php echo $js_base; ?>sidebar-toggle.js"></script>
<?php endif; ?>
<script src="<?php echo $js_base; ?>dropdown-fix.js"></script>
<?php foreach ($additional_js as $js): ?>
    <script src="<?php echo $js_base . $js; ?>"></script>
<?php endforeach; ?>
</body>
</html>