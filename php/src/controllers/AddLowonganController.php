<?php
namespace app\controllers;

use app\core\Application;
use app\models\LowonganModel;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;
use app\core\FileManager;
use Exception;

class AddLowonganController extends Controller {
  private LowonganModel $lowonganModel;
  private SessionManager $sessionManager;
  private FileManager $fileManager;
  public function __construct() {
    $this->sessionManager = SessionManager::getInstance();
    $this->lowonganModel = new LowonganModel();
    $this->fileManager = FileManager::getInstance();
    $this->extractMessage();
  }

  public function addLowonganPage(Request $request) {
    if (!$this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/login");
      return;
    }
    if ($this->sessionManager->isJobSeeker()) {
      $path = __DIR__ . '/../views/not-found/NotFoundView.php';
      $this->render($path);
      return;
    }
    $path = __DIR__ . '/../views/addlowongan/AddLowonganView.php';
    $params = $this->sessionManager->getUserId();
    $data = $this->getCompanies($params);
    $this->render($path, $data);
  }

  public function addLowongan(Request $request) : void {
    $body = $request->getBody();
    $position = $body['position'];
    $companyName = $body['companyName'];
    $location = $body['location'];
    $jobType = $body['jobType'];
    $status = $body['status'];
    $htmlContent = $body['htmlContent'];

    $file_names = [];
    if (isset($_FILES['files'])) {
      foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
          array_push($file_names, substr($this->fileManager->saveImage($tmpName),21));
      }
    }

    try {
      $lastId = $this->lowonganModel->insertJob(
        $position, $companyName, $location,
        $jobType, $status, $htmlContent
      );
      if ($_FILES) {
        $this->lowonganModel->insertAttachment($lastId, $file_names);
      }
      $this->setSuccessMessage('Job added successfully!');
      echo Application::$app->response->jsonEncodes(200, ['message' => "/lowongan/$lastId"]);
    } catch (Exception $e) {
      $this->setErrorMessage('Please fill the job name!');
      echo Application::$app->response->jsonEncodes(400, ['message' => $e->getMessage()]);
    }
  }

  public function getCompanies($params) {
    try {
      $data = $this->lowonganModel->queryCompanies($params);
      return $data;
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }
}