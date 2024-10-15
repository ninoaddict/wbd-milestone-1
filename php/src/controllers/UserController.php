<?php
class UserController extends Controller implements ControllerInterface {
  private UserModel $userModel;
  public function __construct() {
    $this->userModel = $this->model('UserModel');
  }
  public function index() {
    $notFoundView = $this->view('not-found', 'NotFoundView');
    $notFoundView->render();
  }

  public function login() {
    
  }

  public function register() {

  }

  public function logout() {

  }
}