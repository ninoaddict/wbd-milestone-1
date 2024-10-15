<?php

require_once __DIR__ . '/core/Application.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Request.php';
require_once __DIR__ . '/core/Response.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/SessionManager.php';

require_once __DIR__ . '/db/DBconn.php';

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/UserController.php';

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Router;
use app\core\SessionManager;

use app\db\DBconn;

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