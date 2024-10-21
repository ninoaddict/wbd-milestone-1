<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CompanyProfileModel;
use Exception;


class CompProfileController extends Controller {   
    private int $params = 0;
    private CompanyProfileModel $companyProfileModel;

    public function __construct() {
        $this->companyProfileModel = new CompanyProfileModel();
    }

    public function companyProfilePage(Request $request){
        $params = $request->getParams()[0];
        $this->params = $params;

        $data = $this->getCompanyProfileByID($params);

        $data['nama'] = ucwords($data['nama']);
        $data['lokasi'] = ucwords($data['lokasi']);

        $path = __DIR__ . '/../views/profile/ProfileView.php';

        $this->render($path, $data);
    }

    public function getCompanyProfileByID(int $id){
        try {
            $data = $this->companyProfileModel->queryCompanyProfile($id);
            return $data;
        } catch (Exception $e) {
            echo Application::$app->response->jsonEncodes(400, ['message' => 'Failed to retrieve company profile']);
        }
    }
}