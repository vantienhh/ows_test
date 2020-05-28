<?php

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

try {
    $router = new Core\Router();

    $router->add('/login', ['controller' => 'AccountController', 'action' => 'login']);
    $router->add('/logout', ['controller' => 'AccountController', 'action' => 'logout']);
    //    $router->add('/me/update', ['controller' => 'AccountController', 'action' => 'update']);

    $router->dispatch($_SERVER['PATH_INFO']);
} catch (\App\Exceptions\ConnectDatabaseException $e) {
    echo json_encode([
        'code'   => 500,
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
} catch (\Exception $e) {
    echo $e;
}
