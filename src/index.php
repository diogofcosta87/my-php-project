<?php
// This is the main entry point of the application.
// Include necessary files and handle routing here.

require_once __DIR__ . '/../vendor/autoload.php';

// Example routing logic
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Simple routing
switch ($requestUri) {
    case '/':
        echo "Welcome to my PHP project!";
        break;
    case '/about':
        echo "This is the about page.";
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>