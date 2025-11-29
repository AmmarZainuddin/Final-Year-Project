<?php
/**
 * RecyConnect - Footer Layout
 * Flexible footer that works for both public and user pages
 */

use App\Config\Config;

$jsUrl = Config::getJsUrl();
$additional_js = $additional_js ?? [];
?>

<?php if (!$is_public): ?>
    </main>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php if (!$is_public && $show_sidebar): ?>
    <script src="<?php echo $jsUrl; ?>sidebar-toggle.js"></script>
<?php endif; ?>
<?php foreach ($additional_js as $js): ?>
    <script src="<?php echo $jsUrl . $js; ?>"></script>
<?php endforeach; ?>
</body>
</html>
