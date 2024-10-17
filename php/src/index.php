<?php
require_once __DIR__ . "/init.php";

use app\core\Application;

use app\controllers\HomeController;
use app\controllers\UserController;
use app\controllers\DetailLowonganController;
use app\controllers\EditLowonganController;
use app\controllers\TambahLowonganController;

if (!session_id()) {
  session_start();
}

$app = new Application();

// add your routers along with its class and function handler

$app->router->get('/', handler: [HomeController::class, 'homePage']);
$app->router->get('/login', handler: [UserController::class, 'loginPage']);
$app->router->get('/register', handler: [UserController::class, 'registerPage']);

$app->router->get('/detaillowongan/:id',handler: [DetailLowonganController::class, 'detailLowonganPage']);
$app->router->post('/detaillowongan/closeopen', handler:[DetailLowonganController::class, 'closeOpenJob']);
$app->router->post('/detaillowongan/delete', handler:[DetailLowonganController::class, 'deleteJob']);

$app->router->get('/editlowongan',handler: [EditLowonganController::class, 'editLowonganPage']);
$app->router->get('/tambahlowongan',handler: [TambahLowonganController::class, 'tambahLowonganPage']);
$app->router->post('/tambahlowongan', handler:[TambahLowonganController::class, 'tambahLowongan']);

$app->run();