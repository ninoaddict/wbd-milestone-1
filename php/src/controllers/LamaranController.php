<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class LamaranController extends Controller {
  public function __construct() {}

  public function addLamaranPage() {
    $path = __DIR__ . '/../views/lamaran/LamaranView.php';
    $this->render($path);
  }

  public function addLamaran() {

  }

  public function detailLamaranPage() {
    $path = __DIR__ . '/../views/lamaran/DetailLamaranView.php';
    $this->render($path);
  }

  public function respondLamaran() {
    
  }
}