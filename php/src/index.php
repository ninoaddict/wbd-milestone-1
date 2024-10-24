<?php
require_once __DIR__ . "/init.php";

use app\core\Application;

use app\controllers\CompProfileController;
use app\controllers\HistoryController;
use app\controllers\HomeController;
use app\controllers\UserController;
use app\controllers\DetailLowonganController;
use app\controllers\EditLowonganController;
use app\controllers\AddLowonganController;
use app\controllers\LamaranController;

session_start();

$app = new Application();

$app->router->get('/', handler: [HomeController::class, 'homePage']);
$app->router->get('/jobs', handler: [HomeController::class, 'getLowonganData']);
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


$app->router->get('/lowongan/:id',handler: [DetailLowonganController::class, 'detailLowonganChoose']);
$app->router->get('/lowongan/:id/applicants', handler: [DetailLowonganController::class,'getApplicantsData']);
$app->router->post('/lowongan/closeopen', handler:[DetailLowonganController::class, 'closeOpenJob']);
$app->router->delete('/lowongan/:id/delete', handler:[DetailLowonganController::class, 'deleteJob']);

$app->router->get('/lowongan/:id/edit',handler: [EditLowonganController::class, 'editLowonganPage']);
$app->router->post('/lowongan/:id/edit',handler: [EditLowonganController::class, 'editLowongan']);

$app->router->get('/lowongan/add',handler: [AddLowonganController::class, 'addLowonganPage']);
$app->router->post('/lowongan/add', handler:[AddLowonganController::class, 'addLowongan']);

$app->router->get('/history', handler: [HistoryController::class, 'historyPage']);
$app->router->get('/profile', handler: [CompProfileController::class,'profilePage']);
$app->router->post('/profile', handler: [CompProfileController::class, 'updateProfile']);

$app->run();