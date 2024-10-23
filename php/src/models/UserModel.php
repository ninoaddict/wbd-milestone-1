<?php
namespace app\models;

use app\db\DBconn;
use Exception;

class UserModel {
  private $db;
  public function __construct() {
    $this->db = DBconn::getInstance();
  }

  public function getAllUsers() {
    $sql = 'SELECT * FROM users';
    $stmt = $this->db->prepare($sql);
    $ok = $this->db->execute($stmt);
    $users = $this->db->fetchAll($stmt);
    return $users;
  }

  public function getUserById(int $id) {
    if (!isset($id)) {
      throw new Exception("ID can't be empty", 400);
    }

    $sql = 'SELECT * FROM users WHERE user_id = :user_id';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':user_id', $id);  
    $ok = $this->db->execute($stmt);
    if (!$ok) {
      throw new Exception("Internal server error", 500);
    }

    $user = $this->db->fetch($stmt);
    return $user;
  }

  public function getUserByEmail(string $email) {
    if (!isset($email)) {
      throw new Exception("Email can't be empty", 400);
    }

    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':email', $email);  
    $ok = $this->db->execute($stmt);
    if (!$ok) {
      throw new Exception("Internal server error", 500);
    }

    $user = $this->db->fetch($stmt);
    return $user;
  }

  public function addUser(string $email, string $hashedPassword, string $role, string $nama) {
    if (empty($email) || empty($hashedPassword) || empty($role) || empty($nama)) {
      throw new Exception("Required fields can't be empty", 400);
    }
    $sql = 'INSERT INTO users(email, password, role, nama) VALUES (:email, :password, :role, :nama) RETURNING user_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':email', $email);
    $this->db->bind($statement, ':password', $hashedPassword);
    $this->db->bind($statement, ':role', $role);
    $this->db->bind($statement, ':nama', $nama);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Internal server error", 500);
    }

    return $this->db->fetchColumn($statement);
  }

  public function addCompany(int $user_id, string $lokasi, string $about) {
    if (empty($user_id) || empty($lokasi) || empty($about)) {
      throw new Exception("Required fields can't be empty", 400);
    }
    $sql = 'INSERT INTO company_detail(user_id, lokasi, about) VALUES (:user_id, :lokasi, :about) RETURNING user_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':user_id', $user_id);
    $this->db->bind($statement, ':lokasi', $lokasi);
    $this->db->bind($statement, ':about', $about);

    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Internal server error", 500);
    }

    return $this->db->fetchColumn($statement);
  }

  public function authenticate(string $email, string $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':email', $email);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Internal server error", 500);
    } 
    $user = $statement->fetch();
    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return null;
  }

  public function getCompanyProfile(int $user_id){
    $sql = "SELECT cd.user_id, u.nama, cd.lokasi, cd.about
            FROM company_detail cd 
                JOIN users u
                    ON u.user_id=cd.user_id
            WHERE cd.user_id=:user_id";
    $statement = $this->db->prepare($sql); 
    $this->db->bind($statement, ":user_id", $user_id);
    $this->db->execute($statement);
    return $statement->fetch();
  }
  
  public function updateCompanyProfile(int $user_id, string $nama, string $lokasi, string $about){
    $sql1 = "UPDATE users
            SET nama=:nama
            WHERE user_id=:user_id";
    $statement1 = $this->db->prepare($sql1);
    $this->db->bind($statement1, ":user_id", $user_id);
    $this->db->bind($statement1, ":nama", $nama);
    $exe1 = $this->db->execute($statement1);

    $sql2 = "UPDATE company_detail
            SET lokasi=:lokasi, about=:about
            WHERE user_id=:user_id";
    $statement2 = $this->db->prepare($sql2);
    $this->db->bind($statement2, ":user_id", $user_id);
    $this->db->bind($statement2, ":lokasi", $lokasi);
    $this->db->bind($statement2, ":about", $about);
    $exe2 = $this->db->execute($statement2);

    if ($exe1 && $exe2) {
        return true;
    } else {
        echo "Update query error!";
    }
}
}