<?php
namespace app\core;

class SessionManager {
  private static $instance = null;
  private function __construct() {}
  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new SessionManager();
    } 
    return self::$instance;
  }

  public function login($email, $nama, $role, $user_id) {
    if (isset($_SESSION['user_id'])) return false;

    $_SESSION['email'] = $email;
    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role;
    $_SESSION['user_id'] = $user_id;
    return true;
  }

  public function logout() {
    if (!isset($_SESSION['user_id'])) return false;

    unset($_SESSION['email']);
    unset($_SESSION['nama']);
    unset($_SESSION['role']);
    unset($_SESSION['user_id']);
    return true;
  }

  public function isLoggedIn() {
    return isset($_SESSION['user_id']);
  }

  public function getRole() {
    return $_SESSION['role'];
  }

  public function getUserId() {
    return $_SESSION['user_id'];
  }

  public function getName() {
    return $_SESSION['nama'];
  }

  public function getEmail() {
    return $_SESSION['email'];
  }

  public function isCompany() {
    return $this->getRole() == 'company';
  }

  public function isJobSeeker() {
    return $this->getRole() == 'jobseeker';
  }
}