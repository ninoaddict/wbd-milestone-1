<?php
namespace app\core;

class Controller {
  public $data;
  public $errorMessage;
  public $successMessage;

  public function render(string $path, $data = []) {
    $this->data = $data;
    $errorMessage = $this->errorMessage;
    $successMessage = $this->successMessage;
    require_once $path; 
  }

  public function setErrorMessage(string $errorMessage) {
    $_SESSION['error_msg'] = $errorMessage;
  }

  public function setSuccessMessage(string $successMessage) {
    $_SESSION['success_msg'] = $successMessage;
  }

  public function getErrorMessage() {
    $errorMsg = $_SESSION['error_msg'] ?? null;
    unset($_SESSION['error_msg']);

    $this->errorMessage = $errorMsg;
  }

  public function getSuccessMessage() {
    $successMsg = $_SESSION['success_msg'] ?? null;
    unset($_SESSION['success_msg']);

    $this->successMessage = $successMsg;
  }

  public function extractMessage() {
    $this->getErrorMessage();
    $this->getSuccessMessage();
  }
}