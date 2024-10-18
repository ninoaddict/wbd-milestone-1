<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller {
  public function __construct() {
    $this->extractMessage();
  }

  public function homePage(Request $request) {
    $path = __DIR__ . '/../views/home/HomeView.php';
    
    $this->render($path);
  }
}