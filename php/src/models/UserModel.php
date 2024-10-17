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
      throw new Exception("Database error: Unable to execute query.");
    }

    $sql = 'SELECT * FROM users WHERE user_id = :user_id';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':user_id', $id);  
    $ok = $this->db->execute($stmt);
    if (!$ok) {
      throw new Exception("Database error: Unable to execute query.");
    }

    $user = $this->db->fetch($stmt);
    return $user;
  }

  public function getUserByEmail(string $email) {
    if (!isset($email)) {
      throw new Exception("Database error: Unable to execute query.");
    }

    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':email', $email);  
    $ok = $this->db->execute($stmt);
    if (!$ok) {
      throw new Exception("Database error: Unable to execute query.");
    }

    $user = $this->db->fetch($stmt);
    return $user;
  }

  public function addUser(string $email, string $hashedPassword, string $role, string $nama) {
    if (empty($email) || empty($hashedPassword) || empty($role) || empty($nama)) {
      throw new Exception("Database error: Unable to execute query.");
    }
    $sql = 'INSERT INTO users(email, password, role, nama) VALUES (:email, :password, :role, :nama)';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':email', $email);
    $this->db->bind($statement, ':password', $hashedPassword);
    $this->db->bind($statement, ':role', $role);
    $this->db->bind($statement, ':nama', $nama);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Unable to add users");
    }

    return $this->db->lastInsertId();
  }

  public function addCompany(int $user_id, string $lokasi, string $about) {
    if (empty($user_id) || empty($lokasi) || empty($about)) {
      throw new Exception("Database error: Unable to execute query.");
    }
    $sql = 'INSERT INTO company_detail(user_id, lokasi, about) VALUES (:user_id, :lokasi, :about)';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':user_id', $user_id);
    $this->db->bind($statement, ':lokasi', $lokasi);
    $this->db->bind($statement, ':about', $about);

    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to execute query.");
    }

    return $this->db->lastInsertId();
  }

  public function authenticate(string $email, string $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':email', $email);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to execute query.");
    } 
    $user = $statement->fetch();
    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return null;
  }
}