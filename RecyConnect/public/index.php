<?php
/**
 * RecyConnect - Entry Point
 * All requests are routed through this file
 */

// Load autoloader and configuration
require_once __DIR__ . '/../app/autoload.php';
require_once __DIR__ . '/../app/Config/Env.php';
require_once __DIR__ . '/../app/Config/Config.php';

use App\Config\Env;
use App\Config\Config;

// Load environment variables
Env::load();

// Start session
Config::startSession();

// Load routes
$routes = require __DIR__ . '/../routes/web.php';

// Get current request path
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = dirname($_SERVER['SCRIPT_NAME']);

// Get the base path (directory containing index.php)
$basePath = rtrim($scriptName, '/');

// Extract the route path from the request URI
$path = $requestUri;

// Try to remove the base path first (when accessing through public/)
if ($basePath && strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
} else {
    // If base path doesn't match, the request might be coming from root
    // Try removing known base paths to extract the route
    $knownBases = [
        '/fyp1/RecyConnect/public',
        '/fyp1/RecyConnect',
        $basePath
    ];
    
    // Remove empty values and sort by length (longest first)
    $knownBases = array_filter($knownBases, function($b) { return !empty($b); });
    usort($knownBases, function($a, $b) {
        return strlen($b) - strlen($a);
    });
    
    foreach ($knownBases as $base) {
        if (strpos($path, $base) === 0) {
            $path = substr($path, strlen($base));
            break;
        }
    }
}

// Clean up the path - remove leading/trailing slashes
$path = trim($path, '/');

// Remove query string if any
$path = strtok($path, '?');

// Normalize: empty path means root
if (empty($path)) {
    $path = '';
}

// Debug mode (set to false in production)
$debug = false; // Set to true to see path extraction details

if ($debug) {
    echo "<!-- DEBUG: requestUri=$requestUri, basePath=$basePath, extracted path=$path -->";
}

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Find matching route
$matchedRoute = null;
foreach ($routes as $route) {
    $routePath = trim($route['path'], '/');
    
    // Handle root path matching (both empty after trim)
    if ($routePath === '' && $path === '') {
        if ($route['method'] === $method) {
            $matchedRoute = $route;
            break;
        }
    }
    
    // Exact match for non-root paths
    if ($routePath !== '' && $routePath === $path && $route['method'] === $method) {
        $matchedRoute = $route;
        break;
    }
    
    // Match with parameters (simple implementation)
    if ($route['method'] === $method && !empty($routePath) && !empty($path)) {
        $pattern = '#^' . preg_replace('/\{[^}]+\}/', '[^/]+', $routePath) . '$#';
        if (preg_match($pattern, $path)) {
            $matchedRoute = $route;
            break;
        }
    }
}

// Handle route
if ($matchedRoute) {
    $controllerName = $matchedRoute['controller'];
    $actionName = $matchedRoute['action'];
    
    // Convert controller name to class name
    $controllerClass = "App\\Controllers\\{$controllerName}";
    
    // Check if controller exists
    if (class_exists($controllerClass)) {
        try {
            $controller = new $controllerClass();
            
            // Check if action exists
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                http_response_code(404);
                die("Action not found: {$actionName} in {$controllerName}");
            }
        } catch (\Exception $e) {
            http_response_code(500);
            die("Error: " . $e->getMessage());
        }
    } else {
        http_response_code(404);
        die("Controller not found: {$controllerClass}. Path: {$path}");
    }
} else {
    // 404 - Route not found
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>404 - Page Not Found</title>
        <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
            h1 { font-size: 72px; color: #11998e; }
            .debug { background: #f0f0f0; padding: 20px; margin: 20px auto; max-width: 600px; text-align: left; border-radius: 8px; }
        </style>
    </head>
    <body>
        <h1>404</h1>
        <p>Page not found</p>
        <div class="debug">
            <p><strong>Requested path (extracted):</strong> <?php echo htmlspecialchars($path); ?></p>
            <p><strong>Request URI:</strong> <?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? ''); ?></p>
            <p><strong>Script Name:</strong> <?php echo htmlspecialchars($_SERVER['SCRIPT_NAME'] ?? ''); ?></p>
            <p><strong>Base Path:</strong> <?php echo htmlspecialchars($basePath ?? 'N/A'); ?></p>
            <p><strong>Method:</strong> <?php echo htmlspecialchars($method); ?></p>
            <p><strong>Available Routes:</strong></p>
            <ul style="text-align: left; max-width: 400px; margin: 10px auto;">
                <?php foreach ($routes as $r): ?>
                    <li><?php echo htmlspecialchars($r['method'] . ' ' . $r['path'] . ' -> ' . $r['controller'] . '::' . $r['action']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="<?php echo Config::getBaseUrl(); ?>public/">Go Home</a>
    </body>
    </html>
    <?php
}

