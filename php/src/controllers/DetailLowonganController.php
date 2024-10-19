<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Application;
use app\models\LowonganModel;
use Exception;

class DetailLowonganController extends Controller {
  private int $params = 0;
  private bool $job_status;
  private LowonganModel $lowonganModel;
  public function __construct() {
    $this->lowonganModel = new LowonganModel();
  }

  public function detailLowonganPage(Request $request) {
    $params = $request->getParams()[0];
    $this->params = $params;
    $lamarans = $this->getLamaranById($params);
    for ($i = 0; $i < count($lamarans); $i++) {
      $lamarans[$i]['status'] = ucfirst($lamarans[$i]['status']);
    }
    $data = $this->getDetailsbyId($params);
    $data['jenis_pekerjaan'] = str_replace(' ','-',ucwords(str_replace('-',' ', $data['jenis_pekerjaan'])));
    $data['jenis_lokasi'] = str_replace(' ','-',ucwords(str_replace('-',' ', $data['jenis_lokasi'])));
    if ($data['is_open']) {
      $data['is_open'] = "Close Job";
    } else {
      $data['is_open'] = "Open Job";
    }
    $data['lamaran'] = $lamarans;
    $path = __DIR__ . '/../views/detaillowongan/DetailLowonganView.php';
    $this->render($path, $data);
  }

  public function detailLowonganJSeekerPage(Request $request) {
    $params = $request->getParams()[0];
    $this->params = $params;
    $data = $this->getDetailsbyId($params);
    $data['jenis_pekerjaan'] = str_replace(' ','-',ucwords(str_replace('-',' ', $data['jenis_pekerjaan'])));
    $data['jenis_lokasi'] = str_replace(' ','-',ucwords(str_replace('-',' ', $data['jenis_lokasi'])));
    if ($data['is_open']) {
      $data['is_open'] = "Close Job";
    } else {
      $data['is_open'] = "Open Job";
    }
    $path = __DIR__ . '/../views/detaillowonganjs/DetailLowonganJsView.php';
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

  public function getLamaranById(int $id) {
    try {
      $data = $this->lowonganModel->queryLamaranById($id);
      return $data;
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }

  public function closeOpenJob(Request $request) {
    try {
      $body = $request->getBody();
      $id = $body['id'];
      $this->lowonganModel->queryCloseById($id);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to close']);
    }
  }

  public function deleteJob(Request $request) {
    try {
      $body = $request->getBody();
      $id = $body['id'];
      $this->lowonganModel->queryDeleteById($id);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }
}