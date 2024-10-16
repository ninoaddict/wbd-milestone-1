<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class DetailLowonganController extends Controller {
  public function __construct() {}

  public function detailLowonganPage(Request $request) {
    $path = __DIR__ . '/../views/detaillowongan/DetailLowonganView.php';
    $data = ["Volvo", "BMW", "Toyota"];
    $this->render($path, $data);
  }
}