<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class LamaranController extends Controller {
  public function __construct() {}

  public function applyLowonganPage() {
    $path = __DIR__ . '/../views/lamaran/LamaranView.php';
    $this->render($path);
  }

  public function applyLowongan() {
    
  }

  public function detailLamaranPage() {
    $path = __DIR__ . '/../views/lamaran/DetailLamaranView.php';
    $this->render($path);
  }

  public function respondLamaran() {
    
  }
}