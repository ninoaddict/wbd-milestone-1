<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class TambahLowonganController extends Controller {
  public function __construct() {}

  public function tambahLowonganPage(Request $request) {
    $path = __DIR__ . '/../views/tambahlowongan/TambahLowonganView.php';
    $data = ["Volvo", "BMW", "Toyota"];
    $this->render($path, $data);
  }
}