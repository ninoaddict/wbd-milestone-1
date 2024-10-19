<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Application;
use app\models\LowonganModel;
use Exception;

class EditLowonganController extends Controller {
  private LowonganModel $lowonganModel;
  public function __construct() {
    $this->lowonganModel = new LowonganModel();
  }

  public function editLowonganPage(Request $request) {
    $params = $request->getParams()[0];
    $data = $this->getDetailsbyId($params);
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
    echo Application::$app->response->jsonEncodes(200, ['message' => 'Berhasil']);

    $body = $request->getBody();
    $position = $body['position'];
    $companyName = $body['companyName'];
    $location = $body['location'];
    $jobType = $body['jobType'];
    $status = $body['status'];
    $htmlContent = $body['htmlContent'];
    $lowongan_id = $body['lowongan_id'];

    echo Application::$app->response->jsonEncodes(200, ['message' => html_entity_decode($htmlContent)]);

    try {
      $this->lowonganModel->updateJob(
        $position, $companyName, $location,
        $jobType, $status, $htmlContent, $lowongan_id
      );
      echo Application::$app->response->jsonEncodes(200, ['message' => 'Job posted successfully']);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }
}