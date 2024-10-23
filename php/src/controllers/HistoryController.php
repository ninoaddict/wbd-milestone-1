<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\HistoryModel;
use Exception;

class HistoryController extends Controller{
    private HistoryModel $historyModel;

    public function __construct(){
        $this->historyModel = new HistoryModel();
    }

    public function historyPage(Request $request){
        $user_id = $_SESSION['user_id'];
        $queryParams = $request->getQuery();
        $status = $queryParams['status'] ?? 'all';


        if ($status==='all'){
            $historyList = $this->historyModel->getAllLamaranHistory($user_id);
        }
        else {
            $historyList = $this->historyModel->getSelectedLamaranHistory($user_id, $status);
        }

        $path = __DIR__ . '/../views/history/HistoryView.php';
        $this->render($path, ['historyList' => $historyList, 'selectedStatus' => $status]);
    }
}