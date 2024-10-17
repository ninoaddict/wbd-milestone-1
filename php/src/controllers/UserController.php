<?php
namespace app\controllers;

use app\core\Application;
use app\models\UserModel;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;
use Exception;

class UserController extends Controller
{
  private UserModel $userModel;
  private SessionManager $sessionManager;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->sessionManager = SessionManager::getInstance();
  }

  public function loginPage()
  {
    if ($this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/");
      return;
    }
    $path = __DIR__ . '/../views/auth/LoginView.php';
    $this->render($path);
  }

  public function loginPageWithError($data)
  {
    if ($this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/");
      return;
    }
    $path = __DIR__ . '/../views/auth/LoginView.php';
    $this->render($path, $data);
  }

  public function registerPage()
  {
    if ($this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/");
      return;
    }
    $path = __DIR__ . '/../views/auth/RegisterView.php';
    $this->render($path);
  }

  public function login(Request $request)
  {
    if ($this->sessionManager->isLoggedIn()) {
      echo Application::$app->response->jsonEncodes(500, ['msg' => 'User has logged in']);
      return;
    }
    $body = $request->getBody();
    $email = $body['email'];
    $password = $body['password'];
    $valid = $this->userModel->authenticate($email, $password);
    if ($valid) {
      $this->sessionManager->login($valid['email'], $valid['nama'], $valid['role'], $valid['user_id']);
      Application::$app->response->redirect('/');
    } else {
      // Application::$app->response->redirect('/login');
      $this->loginPageWithError(['message'=>'User not found']);
    }
  }

  public function register(Request $request)
  {
    if ($this->sessionManager->isLoggedIn()) {
      echo Application::$app->response->jsonEncodes(500, ['message' => 'User has logged in']);
      return;
    }
    $body = $request->getBody();
    $name = $body['name'];
    $email = $body['email'];
    $password = $body['password'];

    $currType = $body['reg-type'];
    $location = $body['location'];
    $about = $body['about'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    try {
      $user_id = $this->userModel->addUser($email, $hashedPassword, $currType, $name);

      if ($currType === 'company') {
        $this->userModel->addCompany($user_id, $location, $about);
      }

      $this->sessionManager->login($email, $name, $currType, $user_id);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'User already exists']);
    }
  }

  public function logout()
  {
    $this->sessionManager->logout();
    Application::$app->response->redirect('/login');
  }
}