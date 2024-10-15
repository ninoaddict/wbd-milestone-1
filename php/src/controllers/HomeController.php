<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller {
  public function __construct() {}

  public function getHome(Request $request) {
    $path = __DIR__ . '/../views/home/HomeView.php';
    $data = ["Volvo", "BMW", "Toyota"];
    $this->render($path, $data);
  }
}