<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\FileManager;
use app\core\Request;
use app\core\SessionManager;
use app\models\LamaranModel;
use Exception;

class LamaranController extends Controller
{
  private SessionManager $sessionManager;

  private FileManager $fileManager;
  private LamaranModel $lamaranModel;

  public function __construct()
  {
    $this->lamaranModel = new LamaranModel();
    $this->sessionManager = SessionManager::getInstance();
    $this->fileManager = FileManager::getInstance();
  }

  public function applyLowonganPage(Request $request)
  {
    if (!$this->sessionManager->isLoggedIn() || !$this->sessionManager->isJobSeeker()) {
      Application::$app->response->redirect("/");
      return;
    }

    $lowongan_id = $request->getParams()[0];
    $user_id = $this->sessionManager->getUserId();

    if (empty($this->lamaranModel->getLowonganById($lowongan_id)['lowongan_id'])) {
      Application::$app->response->redirect("/not-found");
      return;
    }


    if (!empty($this->lamaranModel->getLamaranDataUser($lowongan_id, $user_id)['lamaran_id'])) {
      Application::$app->response->redirect("/");
      return;
    }

    $company_name = $this->lamaranModel->getCompanyName($lowongan_id);
    $name = $this->sessionManager->getName();
    $email = $this->sessionManager->getEmail();

    $data = ['company_name' => $company_name, 'name' => $name, 'email' => $email, 'lowongan_id' => $lowongan_id];

    $path = __DIR__ . '/../views/lamaran/LamaranView.php';
    $this->render($path, $data);
  }

  public function applyLowongan(Request $request)
  {
    $lowongan_id = $request->getParams()[0];
    $user_id = $this->sessionManager->getUserId();

    try {
      $pdfFile = $_FILES['pdf_input']['tmp_name'];
      $videoFile = $_FILES['video_input']['tmp_name'];

      $uploadedPdf = $this->fileManager->savePdf($pdfFile);
      $pdfPath = '/' . substr($uploadedPdf, 22);

      $uploadedVideo = '';
      $videoPath = '';
      if (!empty($videoFile)) {
        $uploadedVideo = $this->fileManager->saveVideo($videoFile);
        $videoPath = '/' . substr($uploadedVideo,22);
      }
      
      $res = $this->lamaranModel->addLamaran($user_id, $lowongan_id, $pdfPath, $videoPath);
      if (empty($res)) {
        if (!empty($uploadedVideo)) {
          $this->fileManager->delete($uploadedVideo);
        }
        if (!empty($uploadedPdf)) {
          $this->fileManager->delete($uploadedPdf);
        }
        throw new Exception('Fail to add lamaran');
      }
      Application::$app->response->redirect('/lowongan' . '/' . $lowongan_id);
    } catch (Exception $e) {
      Application::$app->response->redirect('/lowongan' . '/' . $lowongan_id .'/apply');
    }
  }

  public function detailLamaranPage(Request $request)
  {
    if (!$this->sessionManager->isLoggedIn() || !$this->sessionManager->isCompany()) {
      Application::$app->response->redirect("/");
      return;
    }

    $lamaran_id = $request->getParams()[0];
    $company_id = $this->sessionManager->getUserId();
    $lamaran = $this->lamaranModel->getLamaranData($lamaran_id, $company_id);

    if (!$lamaran) {
      Application::$app->response->redirect("/");
    }

    $path = __DIR__ . '/../views/lamaran/DetailLamaranView.php';
    $this->render($path, $lamaran);
  }

  public function respondLamaran(Request $request)
  {
    try {
      if (!$this->sessionManager->isLoggedIn() || !$this->sessionManager->isCompany()) {
        echo Application::$app->response->jsonEncodes(500, ['msg' => 'User is not authorized']);
        return;
      }
      $lamaran_id = $request->getParams()[0];
      $company_id = $this->sessionManager->getUserId();
      $authorized = $this->lamaranModel->isCompanyAuthorized($lamaran_id, $company_id);

      if (!$authorized) {
        echo Application::$app->response->jsonEncodes(500, ['msg' => 'User is not authorized']);
        return;
      }

      $body = $request->getBody();
      $new_status = $body['status'];
      $status_reason = $body['status_reason'];

      $this->lamaranModel->updateStatusLamaran($lamaran_id, $new_status, $status_reason);
      echo Application::$app->response->jsonEncodes(200, ['msg' => 'Status updated successfully']);
    } catch (Exception $e) {
      echo Application::$app->response->jsonEncodes(500, ['msg' => $e->getMessage()]);
    }
  }
}