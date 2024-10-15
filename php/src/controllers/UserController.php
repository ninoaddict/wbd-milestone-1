<?php
namespace app\controllers;

use app\model\UserModel;
use app\core\Controller;

class UserController extends Controller {
  private UserModel $userModel;

  public function __construct() {
    $this->userModel = new UserModel();
  }

  public function loginPage() {

  }

  public function registerPage() {

  }

  public function login() {

  }

  public function register() {

  }

  public function logout() {
    
  }
}