<?php
require_once __DIR__ . "/init.php";

use app\core\Application;

use app\controllers\HomeController;
use app\controllers\UserController;
use app\controllers\DetailLowonganController;
use app\controllers\EditLowonganController;
use app\controllers\TambahLowonganController;
use app\controllers\LamaranController;

session_start();

$app = new Application();

$app->router->get('/', handler: [HomeController::class, 'homePage']);
$app->router->get('/page-not-found', handler: [HomeController::class, 'notFoundPage']);

$app->router->get('/login', handler: [UserController::class, 'loginPage']);
$app->router->post('/login', handler: [UserController::class, 'login']);

$app->router->get('/register', handler: [UserController::class, 'registerPage']);
$app->router->post('/register', handler: [UserController::class, 'register']);

$app->router->post('/logout', handler: [UserController::class, 'logout']);

$app->router->get('/lowongan/:id/apply', handler: [LamaranController::class,'applyLowonganPage']);
$app->router->post('/lowongan/:id/apply', handler: [LamaranController::class,'applyLowongan']);
$app->router->get('/lamaran/:id', handler: [LamaranController::class, 'detailLamaranPage']);
$app->router->post('/lamaran/:id', handler: [LamaranController::class, 'respondLamaran']);

$app->router->get('/detaillowongan/:id',handler: [DetailLowonganController::class, 'detailLowonganPage']);
$app->router->post('/detaillowongan/closeopen', handler:[DetailLowonganController::class, 'closeOpenJob']);
$app->router->post('/detaillowongan/delete', handler:[DetailLowonganController::class, 'deleteJob']);

$app->router->get('/detaillowonganjs/:id',handler: [DetailLowonganController::class, 'detailLowonganJSeekerPage']);

$app->router->get('/editlowongan/:id',handler: [EditLowonganController::class, 'editLowonganPage']);
$app->router->post('/editlowongan',handler: [EditLowonganController::class, 'editLowongan']);

$app->router->get('/tambahlowongan',handler: [TambahLowonganController::class, 'tambahLowonganPage']);
$app->router->post('/tambahlowongan', handler:[TambahLowonganController::class, 'tambahLowongan']);

$app->run();