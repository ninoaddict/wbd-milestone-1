<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LamaranModel;
use Exception;

class HistoryController extends Controller{
    private LamaranModel $lamaranModel;

    public function __construct(){
        $this->lamaranModel = new LamaranModel();
    }

    public function historyPage(Request $request){
        if ($_SESSION['role'] === 'jobseeker'){

            $user_id = $_SESSION['user_id'];
            $queryParams = $request->getQuery();
            $status = $queryParams['status'] ?? 'all';
            
            
            if ($status==='all'){
                $historyList = $this->lamaranModel->getAllLamaranHistory($user_id);
            } else {
                $historyList = $this->lamaranModel->getSelectedLamaranHistory($user_id, $status);
            }
            
            $path = __DIR__ . '/../views/history/HistoryView.php';
            $this->render($path, ['historyList' => $historyList, 'selectedStatus' => $status]);
        } else {
            $path = __DIR__ . '/../views/not-found/NotFoundView.php';
            $this->render($path);
        }
    }
}