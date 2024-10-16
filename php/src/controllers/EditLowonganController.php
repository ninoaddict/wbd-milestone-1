<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class EditLowonganController extends Controller {
  public function __construct() {}

  public function editLowonganPage(Request $request) {
    $path = __DIR__ . '/../views/editlowongan/EditLowonganView.php';
    $data = ["Volvo", "BMW", "Toyota"];
    $this->render($path, $data);
  }
}