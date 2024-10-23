<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CompanyProfileModel;
use app\models\UserModel;
use Exception;


class CompProfileController extends Controller {   
    private int $params = 0;
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function profilePage(Request $request){
        $user_id = $_SESSION["user_id"];
        $companyProfile = $this->userModel->getCompanyProfile($user_id);
        $path = __DIR__ . '/../views/profile/ProfileView.php';
        $this->render($path, ['companyProfile' => $companyProfile]);
    }

    public function updateProfile(Request $request){
        $user_id = $_SESSION['user_id'];
        $body = $request->getBody();

        if ($this->userModel->updateCompanyProfile($user_id, $body['nama'], $body['lokasi'], $body['about'])){
            $_SESSION['nama'] = $body['nama'];
            header('Location: /profile');
            exit();
        } else {
          $this->setErrorMessage('Not found');
          header('Location: /profile');
        }
    }
}