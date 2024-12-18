<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CompanyProfileModel;
use app\models\UserModel;
use Exception;


class CompProfileController extends Controller {
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->extractMessage();
    }

    public function profilePage(Request $request){
        if ($_SESSION["role"] === 'jobseeker'){
            $path = __DIR__ . '/../views/not-found/NotFoundView.php';
            $this->render($path);
        } else {
            $user_id = $_SESSION["user_id"];
            $companyProfile = $this->userModel->getCompanyProfile($user_id);
            $path = __DIR__ . '/../views/profile/ProfileView.php';
            $this->render($path, ['companyProfile' => $companyProfile]);
        }
    }

    public function updateProfile(Request $request){
        if ($_SESSION['role'] === 'jobseeker'){
            header('Location: /page-not-found');
            exit();
        } else {
            $user_id = $_SESSION['user_id'];
            $body = $request->getBody();
            
            if ($this->userModel->updateCompanyProfile($user_id, $body['nama'], $body['lokasi'], $body['about'])){
                $_SESSION['nama'] = $body['nama'];
                $this->setSuccessMessage('Successfully updated profile!');
                header('Location: /profile');
                exit();
            } else {
                $this->setErrorMessage('Update profile failed!');
                header('Location: /profile');
            }
        }
    }
}