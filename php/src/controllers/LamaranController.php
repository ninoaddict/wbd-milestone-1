<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;
use app\models\LamaranModel;
use Error;

class LamaranController extends Controller
{
  private SessionManager $sessionManager;
  private LamaranModel $lamaranModel;

  public function __construct()
  {
    $this->lamaranModel = new LamaranModel();
    $this->sessionManager = SessionManager::getInstance();
  }

  public function applyLowonganPage()
  {
    $path = __DIR__ . '/../views/lamaran/LamaranView.php';
    $this->render($path);
  }

  public function applyLowongan()
  {

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
    } catch (Error $e) {
      echo Application::$app->response->jsonEncodes(500, ['msg' => 'Failed to update status']);
    }
  }
}