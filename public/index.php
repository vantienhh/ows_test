<?php

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

try {
    $router = new Core\Router();

    $router->add('/login', ['controller' => 'AccountController', 'action' => 'login']);
    $router->add('/logout', ['controller' => 'AccountController', 'action' => 'logout']);
    $router->add('/profile', ['controller' => 'UserController', 'action' => 'profile']);
    $router->add('/me/update', ['controller' => 'UserController', 'action' => 'updateProfile']);

    $router->dispatch($_SERVER['PATH_INFO']);
} catch (\App\Exceptions\ConnectDatabaseException $e) {
    echo json_encode([
        'code'    => 500,
        'status'  => 'error',
        'message' => $e->getMessage()
    ]);
} catch (\Exception $e) {
    echo $e;
}
