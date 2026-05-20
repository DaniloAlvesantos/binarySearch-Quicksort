<?php

require_once __DIR__ . '/vendor/autoload.php';

$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASE_URL', $base_url);

$routes = [
    'cards'   => ['class' => App\Controllers\BookController::class, 'method' => 'cards'],
    'book'    => ['class' => App\Controllers\BookController::class, 'method' => 'book'],
    'search'  => ['class' => App\Controllers\BookController::class, 'method' => 'search'],
    'books'   => ['class' => App\Controllers\BookController::class, 'method' => 'books'],
    'authors' => ['class' => App\Controllers\AuthorController::class, 'method' => 'authors'],
    // 'genres'  => ['class' => App\Controllers\GenreController::class, 'method' => 'genres'],
    // 'profile' => ['class' => App\Controllers\UserController::class, 'method' => 'profile'],
    // 'login'   => ['class' => App\Controllers\UserController::class, 'method' => 'login'],
    // 'register'=> ['class' => App\Controllers\UserController::class, 'method' => 'register'],
    // 'logout'  => ['class' => App\Controllers\UserController::class, 'method' => 'logout'],
];

$action = $_GET['action'] ?? 'cards';

if (!array_key_exists($action, $routes)) {
    $action = 'cards';
}

$controllerClass = $routes[$action]['class'];
$methodName = $routes[$action]['method'];

$controller = new $controllerClass();

$controller->$methodName();
