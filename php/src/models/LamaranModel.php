<?php
namespace app\models;
use app\db\DBconn;
use Exception;

class LamaranModel {
  private $db;

  public function __construct() {
    $this->db = DBconn::getInstance();
  }

  public function getAllLamaran() {
    $sql = "SELECT * FROM lamaran";
    $stmt = $this->db->prepare($sql);
    $this->db->execute($stmt);
    return $this->db->fetchAll($stmt);
  }

  public function getLamaranById(int $lamaran_id) {
    if (empty($lamaran_id)) {
      throw new Exception("Lamaran id can't be empty", 400);
    }
    $sql = 'SELECT * FROM lamaran WHERE lamaran_id = :lamaran_id';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':lamaran_id', $lamaran_id);
    $this->db->execute($stmt);
    return $this->db->fetch($stmt);
  }

  public function getLowonganById(int $lowongan_id) {
    if (empty($lowongan_id)) {
      throw new Exception("Lowongan ID can't be empty", 400);
    }
    $sql = 'SELECT * FROM lowongan WHERE lowongan_id = :lowongan_id';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':lowongan_id', $lowongan_id);
    $this->db->execute($stmt);
    return $this->db->fetch($stmt);
  }
 
  public function addLamaran(int $user_id, int $lowongan_id, string $cv_path, $video_path) {
    if (empty($user_id) || empty($lowongan_id) || empty($cv_path)) {
      throw new Exception("Required fields can't be empty", 400);
    }
    $sql = 'INSERT INTO lamaran(user_id, lowongan_id, cv_path, video_path) VALUES (:user_id, :lowongan_id, :cv_path, :video_path) RETURNING lamaran_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':user_id', $user_id);
    $this->db->bind($statement, ':lowongan_id', $lowongan_id);
    $this->db->bind($statement, ':cv_path', $cv_path);
    $this->db->bind($statement, ':video_path', $video_path);
    try {
      $this->db->execute($statement);
      return $this->db->fetchColumn($statement);
    } catch (Exception $e) {
      throw new Exception('Failed to add lamaran', 500);
    }
  }

  public function updateStatusLamaran(int $lamaran_id, string $new_status, $status_reason) {
    if (empty($lamaran_id) || empty($new_status)) {
      throw new Exception("Required fields can't be empty", 400);
    }
    $sql = "UPDATE lamaran SET status = :new_status, status_reason = :status_reason WHERE lamaran_id = :lamaran_id RETURNING lamaran_id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':new_status', $new_status);
    $this->db->bind($statement, ':status_reason', $status_reason);
    $this->db->bind($statement, ':lamaran_id', $lamaran_id);
    $this->db->execute($statement);
    return $this->db->fetchColumn($statement);
  }

  public function isCompanyAuthorized(int $lamaran_id, int $company_id) {
    $sql = 'SELECT * 
    FROM lamaran lam 
    INNER JOIN lowongan low ON lam.lowongan_id = low.lowongan_id 
    WHERE lamaran_id = :lamaran_id 
    AND company_id = :company_id';

    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':lamaran_id', $lamaran_id);
    $this->db->bind($statement, ':company_id', $company_id);
    $this->db->execute($statement);
    $res = $this->db->fetch($statement);
    if ($res) return true;
    return false;
  }

  public function getLamaranDataUser(int $lowongan_id, int $user_id) {
    if (empty($lowongan_id) || empty($user_id)) {
      throw new Exception("Required fields can't be empty", 400);
    }

    $sql = 'SELECT * FROM lamaran 
    WHERE lowongan_id = :lowongan_id 
    AND user_id = :user_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':user_id', $user_id);
    $this->db->bind($statement, ':lowongan_id', $lowongan_id);
    $this->db->execute($statement);
    return $this->db->fetch($statement);
  }

  public function getLamaranData(int $lamaran_id, int $company_id) {
    if (empty($lamaran_id) || empty($company_id)) {
      throw new Exception("Required fields can't be empty", 400);
    }
    
    $sql = 'SELECT lamaran_id, users.user_id, lam.lowongan_id, email, nama, cv_path, video_path, status, status_reason
    FROM lamaran lam 
    INNER JOIN lowongan low ON lam.lowongan_id = low.lowongan_id
    INNER JOIN users ON lam.user_id = users.user_id
    WHERE lamaran_id = :lamaran_id 
    AND company_id = :company_id';

    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':lamaran_id', $lamaran_id);
    $this->db->bind($statement, ':company_id', $company_id);
    $this->db->execute($statement);
    return $this->db->fetch($statement);
  }

  public function getCompanyName(int $lowongan_id) {
    if (empty($lowongan_id)) {
      throw new Exception("Required fields can't be empty", 400);
    }

    $sql = 'SELECT company_id FROM lowongan WHERE lowongan_id = :lowongan_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':lowongan_id', $lowongan_id);
    $this->db->execute($statement);
    $res = $this->db->fetch($statement);
    
    if (empty($res)) {
      throw new Exception('Lowongan not found', 400);
    }

    $sql2 = 'SELECT nama FROM users WHERE user_id = :user_id';
    $stmt = $this->db->prepare($sql2);
    $this->db->bind($stmt, ':user_id', $res['company_id']);
    $this->db->execute($stmt);
    $res = $this->db->fetch($stmt);
    return $res['nama'];
  }
}