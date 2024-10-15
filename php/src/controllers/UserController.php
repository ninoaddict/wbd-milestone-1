<?php
namespace app\controllers;

use app\core\Application;
use app\models\UserModel;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;

class UserController extends Controller {
  private UserModel $userModel;
  private SessionManager $sessionManager;

  public function __construct() {
    $this->userModel = new UserModel();
    $this->sessionManager = SessionManager::getInstance();
  }

  public function loginPage(Request $request) {
    if ($this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/home");
      return;
    }
    $path = __DIR__ . '/../views/auth/LoginView.php';
    $this->render($path);
  }

  public function registerPage() {
    if ($this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/home");
      return;
    }
    $path = __DIR__ . '/../views/auth/RegisterView.php';
    $this->render($path);
  }

  public function login() {

  }

  public function register() {

  }

  public function logout() {
    
  }
}