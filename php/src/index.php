<?php
require_once __DIR__ . "/init.php";

use app\core\Application;

use app\controllers\HomeController;
use app\controllers\UserController;

session_start();

$app = new Application();

// add your routers along with its class and function handler

$app->router->get('/', handler: [HomeController::class, 'homePage']);

$app->router->get('/login', handler: [UserController::class, 'loginPage']);
$app->router->post('/login', handler: [UserController::class, 'login']);

$app->router->get('/register', handler: [UserController::class, 'registerPage']);
$app->router->post('/register', handler: [UserController::class, 'register']);

$app->router->post('/logout', handler: [UserController::class, 'logout']);

$app->run();