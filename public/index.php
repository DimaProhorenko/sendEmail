<?php

use App\Core\Router;
use App\Controllers\Home;

$dirname = dirname(__DIR__, 1);
define('BASE_PATH', $dirname);

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->register_routes([Home::class]);


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
