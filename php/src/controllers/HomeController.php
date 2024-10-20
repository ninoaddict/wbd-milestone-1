<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;

class HomeController extends Controller {
  private SessionManager $sessionManager;
  public function __construct() {
    $this->sessionManager = SessionManager::getInstance();
    $this->extractMessage();
  }

  public function homePage(Request $request) {
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getRole() == "jobseeker") {
      $this->jobSeekerHomePage($request);
    } else {
      $this->companyHomePage($request);
    }
  }

  private function jobSeekerHomePage(Request $request) {
    $path = __DIR__ . '/../views/home/HomeView.php';
    $this->render($path);
  }

  private function companyHomePage(Request $request) {
    $path = __DIR__ . '/../views/home/HomeView.php';
    $this->render($path);
  }

  public function notFoundPage() {
    $path = __DIR__ . '/../views/not-found/NotFoundView.php';
    $this->render($path);
  }
}