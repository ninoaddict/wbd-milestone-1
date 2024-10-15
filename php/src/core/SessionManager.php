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

  public function login($nama, $role, $user_id) {
    if (isset($_SESSION)) return false;

    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role;
    $_SESSION['user_id'] = $user_id;
    return true;
  }

  public function logout() {
    if (!isset($_SESSION)) return false;
    unset($_SESSION['nama']);
    unset($_SESSION['role']);
    unset($_SESSION['user_id']);
    return true;
  }

  public function isLoggedIn() {
    return isset($_SESSION['user_id']);
  }
}