<?php
/**
 * CodeIgniter Router for PHP Built-in Server
 */

$_SERVER['CI_ENVIRONMENT'] = 'development';

// Path to public folder
$publicPath = __DIR__ . DIRECTORY_SEPARATOR . 'public';

// Get the URI
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Handle static files
if ($uri !== '/' && file_exists($publicPath . $uri)) {
    // Check for static file types
    $mimeTypes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'json' => 'application/json',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
    ];
    
    $ext = pathinfo($uri, PATHINFO_EXTENSION);
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        readfile($publicPath . $uri);
        return true;
    }
    return false;
}

// Set up server variables
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $publicPath . '/index.php';

// Change to public directory and run
chdir($publicPath);
require $publicPath . '/index.php';
