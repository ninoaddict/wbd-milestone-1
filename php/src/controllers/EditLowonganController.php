<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Application;
use app\models\LowonganModel;
use app\core\SessionManager;
use app\core\FileManager;
use Exception;

class EditLowonganController extends Controller {
  private LowonganModel $lowonganModel;
  private SessionManager $sessionManager;
  private FileManager $fileManager;
  public function __construct() {
    $this->lowonganModel = new LowonganModel();
    $this->sessionManager = SessionManager::getInstance();
    $this->fileManager = FileManager::getInstance();
  }

  public function editLowonganPage(Request $request) {
    if (!$this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/login");
      return;
    }
    if ($this->sessionManager->isJobSeeker()) {
      $path = __DIR__ . '/../views/not-found/NotFoundView.php';
      $this->render($path);
      return;
    }

    $companyId = $this->sessionManager->getUserId();

    $params = $request->getParams()[0];
    $data = $this->getDetailsbyId($params);

    if ($companyId != $data['company_id']) {
      $path = __DIR__ . '/../views/not-found/NotFoundView.php';
      $this->render($path);
      return;
    }

    if ($data['is_open']) {
      $data['is_open'] = "Open";
    } else {
      $data['is_open'] = "Close";
    }
    
    $path = __DIR__ . '/../views/editlowongan/EditLowonganView.php';
    $this->render($path, $data);
  }

  public function getDetailsById(int $id) {
    try {
      $data = $this->lowonganModel->queryDetailsById($id);
      return $data;
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }

  public function editLowongan(Request $request) : void {
    $body = $request->getBody();
    $position = $body['position'];
    $companyName = $body['companyName'];
    $location = $body['location'];
    $jobType = $body['jobType'];
    $status = $body['status'];
    $htmlContent = $body['htmlContent'];

    $lowongan_id = $request->getParams()[0];

    $files_delete = $this->lowonganModel->queryFilePathByLowonganId($lowongan_id);
    $this->lowonganModel->queryDeleteAttachmentById($lowongan_id);
    if (!empty($files_delete)) {
      for ($i = 0; $i < count($files_delete); $i++) {
        $files_delete[$i] = "/var/www/html/storage/..".$files_delete[$i];
        $this->fileManager->delete($files_delete[$i]);
      }
    }

    $file_names = [];
    if (isset($_FILES['files'])) {
      foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        array_push($file_names, substr($this->fileManager->saveImage($tmpName),21));
      }
    }

    try {
      $this->lowonganModel->updateJob(
        $position, $companyName, $location,
        $jobType, $status, $htmlContent, $lowongan_id
      );
      $this->lowonganModel->insertAttachment($lowongan_id, $file_names);
      echo Application::$app->response->jsonEncodes(200, ['message' => "/lowongan/$lowongan_id"]);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => $e->getMessage()]);
    }
  }
}