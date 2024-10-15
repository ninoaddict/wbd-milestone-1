<?php

require_once __DIR__ . '/core/Application.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Request.php';
require_once __DIR__ . '/core/Response.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/SessionManager.php';

require_once __DIR__ . '/db/DBconn.php';

require_once __DIR__ . '/controllers/HomeController.php';

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Router;
use app\core\SessionManager;

use app\db\DBconn;

use app\controllers\HomeController;

if (!session_id()) {
  session_start();
}

$app = new Application();
$app->router->get('/home', handler: [HomeController::class, 'getHome']);

$app->run();