<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASE_URL', $base_url);

$routes = [
    'cards'   => ['class' => App\Controllers\BookController::class, 'method' => 'cards'],
    'book'    => ['class' => App\Controllers\BookController::class, 'method' => 'book'],
    'create:book'    => ['class' => App\Controllers\BookController::class, 'method' => 'create'],
    'search'  => ['class' => App\Controllers\BookController::class, 'method' => 'search'],
    'books'   => ['class' => App\Controllers\BookController::class, 'method' => 'books'],
    'authors' => ['class' => App\Controllers\AuthorController::class, 'method' => 'authors'],
    'login'   => ['class' => App\Controllers\UserController::class, 'method' => 'login'],
    'create:user' => ['class' => App\Controllers\UserController::class, 'method' => 'create'],
];

$action = $_GET['action'] ?? 'cards';

if (!array_key_exists($action, $routes)) {
    $action = 'cards';
}

$controllerClass = $routes[$action]['class'];
$methodName = $routes[$action]['method'];

$controller = new $controllerClass();
$controller->$methodName();