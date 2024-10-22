<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\SessionManager;
use app\models\LowonganModel;

class HomeController extends Controller
{
  private SessionManager $sessionManager;
  private LowonganModel $lowonganModel;
  public function __construct()
  {
    $this->sessionManager = SessionManager::getInstance();
    $this->extractMessage();
    $this->lowonganModel = new LowonganModel();
  }

  public function homePage(Request $request)
  {
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getRole() == "jobseeker") {
      $this->jobSeekerHomePage($request);
    } else {
      $this->companyHomePage($request);
    }
  }

  private function jobSeekerHomePage(Request $request)
  {
    $data = $this->getLowonganJobSeeker($request);
    $path = __DIR__ . '/../views/home/HomeView.php';
    $this->render($path, $data);
  }

  private function companyHomePage(Request $request)
  {
    $data = $this->getLowonganCompany($request);
    $path = __DIR__ . '/../views/home/CompanyHomeView.php';
    $this->render($path, $data);
  }

  public function getLowonganData(Request $request)
  {
    $data = [];
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getRole() == "jobseeker") {
      $data = $this->getLowonganJobSeeker($request);
    } else {
      $data = $this->getLowonganCompany($request);
    }
    echo Application::$app->response->jsonEncodes(200, $data);
  }

  private function getLowonganJobSeeker(Request $request)
  {
    $query = $request->getQuery()['query'] ?? '';
    $sort = $request->getQuery()['sort'] ?? 'desc';
    $page = $request->getQuery()['page'] ?? 1;
    $limit = $request->getQuery()['limit'] ?? 10;

    $rawJobType = $request->getQuery()['jobtype'] ?? '';
    $rawLocType = $request->getQuery()['loctype'] ?? '';

    $jobType = [];
    $locType = [];

    if (!empty($rawJobType)) {
      $jobType = explode(',', $rawJobType);
    }

    if (!empty($rawLocType)) {
      $locType = explode(',', $rawLocType);
    }

    $data = $this->lowonganModel->getFilterLowongan(query: $query, page: $page, limit: $limit, order: $sort, jobType: $jobType, locationType: $locType);

    $maxPage = $data['maxPage'];
    $lowerPage = max(1, $page - 2);
    $upperPage = min($maxPage, $page + 2);

    if ($page == 1 || $page == 2) {
      $upperPage = min($maxPage, 5);
    } else if ($page == $maxPage) {
      $lowerPage = max(1, $maxPage - 4);
    } else if ($page == $maxPage - 1) {
      $lowerPage = max(1, $maxPage - 4);
    }

    $data['query'] = $query;
    $data['order'] = $sort;
    $data['page'] = $page;
    $data['jobType'] = $jobType;
    $data['locType'] = $locType;
    $data['upperPage'] = $upperPage;
    $data['lowerPage'] = $lowerPage;

    return $data;
  }

  private function getLowonganCompany(Request $request)
  {
    $query = $request->getQuery()['query'] ?? '';
    $sort = $request->getQuery()['sort'] ?? 'desc';
    $page = $request->getQuery()['page'] ?? 1;
    $limit = $request->getQuery()['limit'] ?? 10;

    $rawJobType = $request->getQuery()['jobtype'] ?? '';
    $rawLocType = $request->getQuery()['loctype'] ?? '';

    $jobType = [];
    $locType = [];

    if (!empty($rawJobType)) {
      $jobType = explode(',', $rawJobType);
    }

    if (!empty($rawLocType)) {
      $locType = explode(',', $rawLocType);
    }

    $companyId = $this->sessionManager->getUserId();
    $data = $this->lowonganModel->getFilterLowonganCompany($companyId, query: $query, page: $page, limit: $limit, order: $sort, jobType: $jobType, locationType: $locType);

    $maxPage = $data['maxPage'];
    $lowerPage = max(1, $page - 2);
    $upperPage = min($maxPage, $page + 2);

    if ($page == 1 || $page == 2) {
      $upperPage = min($maxPage, 5);
    } else if ($page == $maxPage) {
      $lowerPage = max(1, $maxPage - 4);
    } else if ($page == $maxPage - 1) {
      $lowerPage = max(1, $maxPage - 4);
    }

    $data['query'] = $query;
    $data['order'] = $sort;
    $data['page'] = $page;
    $data['jobType'] = $jobType;
    $data['locType'] = $locType;
    $data['upperPage'] = $upperPage;
    $data['lowerPage'] = $lowerPage;

    return $data;
  }

  public function notFoundPage()
  {
    $path = __DIR__ . '/../views/not-found/NotFoundView.php';
    $this->render($path);
  }
}