<?php
namespace app\controllers;

use app\core\Application;
use app\models\LowonganModel;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;
use Exception;

class TambahLowonganController extends Controller {
  private LowonganModel $lowonganModel;
  private SessionManager $sessionManager;
  public function __construct() {
    $this->sessionManager = SessionManager::getInstance();
    $this->lowonganModel = new LowonganModel();
  }

  public function tambahLowonganPage(Request $request) {
    $path = __DIR__ . '/../views/tambahlowongan/TambahLowonganView.php';
    $data = ["Volvo", "BMW", "Toyota"];
    $this->render($path, $data);
  }

  public function tambahLowongan(Request $request) : void {
    echo Application::$app->response->jsonEncodes(200, ['message' => 'Berhasil']);
    if ($this->sessionManager->isLoggedIn()) {
      echo Application::$app->response->jsonEncodes(500, ['message' => 'User has logged in']);
      return;
    }
    $body = $request->getBody();
    $position = $body['position'];
    $companyName = $body['companyName'];
    $location = $body['location'];
    $jobType = $body['jobType'];
    $status = $body['status'];
    $htmlContent = $body['htmlContent'];

    echo Application::$app->response->jsonEncodes(200, ['message' => html_entity_decode($htmlContent)]);

    try {
      $this->lowonganModel->insertJob(
        $position, $companyName, $location,
        $jobType, $status, $htmlContent
      );
      echo Application::$app->response->jsonEncodes(200, ['message' => 'Job posted successfully']);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }
}