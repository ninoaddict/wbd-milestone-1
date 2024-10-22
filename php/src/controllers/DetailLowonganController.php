<?php
namespace app\controllers;
use app\core\Controller;
use app\core\FileManager;
use app\core\Request;
use app\core\Application;
use app\models\LowonganModel;
use app\core\SessionManager;
use Exception;

class DetailLowonganController extends Controller {
  private int $params = 0;
  private bool $job_status;
  private LowonganModel $lowonganModel;
  private SessionManager $sessionManager;
  private FileManager $fileManager;
  public function __construct() {
    $this->lowonganModel = new LowonganModel();
    $this->sessionManager = SessionManager::getInstance();
    $this->fileManager = FileManager::getInstance();
  }

  public function detailLowonganChoose(Request $request) {
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getRole() == "jobseeker") {
      $this->detailLowonganJSeekerPage($request);
    } else {
      $this->detailLowonganPage($request);
    }
  }

  public function detailLowonganPage(Request $request) {
    if (!$this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/login");
      return;
    }
    $params = $request->getParams()[0];
    $this->params = $params;
    $lamarans = $this->getLamaranById($params);
    for ($i = 0; $i < count($lamarans); $i++) {
      $lamarans[$i]['status'] = ucfirst($lamarans[$i]['status']);
    }

    $idOfParams = $this->getIdById($params);
    $isMatching = false;
    foreach ($idOfParams as $idParam) {
      if ($idParam['company_id'] == $this->sessionManager->getUserId()) {
        $isMatching = true;
        break;
      }
    }

    if (!$isMatching) {
      Application::$app->response->redirect("/");
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
    $data['file_path'] = $this->getAttachmentsById($params);
    $path = __DIR__ . '/../views/detaillowongan/DetailLowonganView.php';
    $this->render($path, $data);
  }

  public function detailLowonganJSeekerPage(Request $request) {
    if (!$this->sessionManager->isLoggedIn()) {
      Application::$app->response->redirect("/login");
      return;
    }
    $user_id = $this->sessionManager->getUserId();
    $params = $request->getParams()[0];
    $this->params = $params;
    $data = $this->getLamaranInfosById($params, $user_id);
    
    if ($data) {
      $data['status'] = ucfirst($data['status']);
    }
    $new_data = $this->getDetailsbyId($params);
    $new_data['jenis_pekerjaan'] = str_replace(' ','-',ucwords(str_replace('-',' ', $new_data['jenis_pekerjaan'])));
    $new_data['jenis_lokasi'] = str_replace(' ','-',ucwords(str_replace('-',' ', $new_data['jenis_lokasi'])));
    if ($new_data['is_open']) {
      $new_data['is_open'] = "Close Job";
    } else {
      $new_data['is_open'] = "Open Job";
    }

    if (!$data) {
      if ($new_data['is_open']) {
        $data['status'] = 'Available';
      } else {
        $data['status'] = 'Unavailable';
      }
    }
    array_push($data, $new_data);
    $path = __DIR__ . '/../views/detaillowonganjs/DetailLowonganJsView.php';
    $this->render($path, $data);
  }

  public function getIdById(int $id) {
    try {
      $data = $this->lowonganModel->queryUsersIdFromLowonganId($id);
      return $data;
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
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

  public function getLamaranInfosById(int $lowongan_id, int $user_id) {
    try {
      $data = $this->lowonganModel->queryAppliedById($lowongan_id, $user_id);
      return $data;
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }

  public function getAttachmentsById(int $lowongan_id) {
    try {
      $data = $this->lowonganModel->queryFilePathByLowonganId($lowongan_id);
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
      $files = $this->lowonganModel->queryFilePathByLowonganId($id);
      $this->lowonganModel->queryDeleteById($id);
      for ($i = 0; $i < count($files); $i++) {
        $files[$i] = "/var/www/html/storage/..".$files[$i];
        print_r($files[$i]);
        $this->fileManager->delete($files[$i]);
      }
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to insert the data']);
    }
  }
}