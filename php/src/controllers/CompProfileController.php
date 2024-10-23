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

    public function profilePage(Request $request){
        $user_id = $_SESSION["user_id"];
        $companyProfile = $this->companyProfileModel->getCompanyProfile($user_id);
        $path = __DIR__ . '/../views/profile/ProfileView.php';
        $this->render($path, ['companyProfile' => $companyProfile]);
    }

    public function updateProfile(Request $request){
        $user_id = $_SESSION['user_id'];
        $data = $request->getBody();

        if ($this->companyProfileModel->updateCompanyProfile($user_id, $data['nama'], $data['lokasi'], $data['about'])){
            header('Location: /profile');
            exit();
        } else {
            echo "Error updating profile!";
        }
    }
}