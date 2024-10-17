<?php

require_once __DIR__ . '/config/Config.php';

require_once __DIR__ . '/core/Application.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Request.php';
require_once __DIR__ . '/core/Response.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/SessionManager.php';

require_once __DIR__ . '/db/DBconn.php';

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/LamaranController.php';

require_once __DIR__ . '/models/UserModel.php';
require_once __DIR__ . '/models/LamaranModel.php';