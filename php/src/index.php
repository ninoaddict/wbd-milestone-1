<?php
require_once __DIR__ . "/init.php";

use app\core\Application;

use app\controllers\HomeController;
use app\controllers\UserController;

if (!session_id()) {
  session_start();
}

$app = new Application();

// add your routers along with its class and function handler
$app->router->get('/home', handler: [HomeController::class, 'homePage']);
$app->router->get('/login', handler: [UserController::class, 'loginPage']);
$app->router->get('/register', handler: [UserController::class, 'registerPage']);

$app->run();