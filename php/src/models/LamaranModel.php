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
    if (!$lamaran_id) {
      throw new Exception("Lamaran id can't be empty");
    }
    $sql = 'SELECT * FROM lamaran WHERE lamaran_id = :lamaran_id';
    $stmt = $this->db->prepare($sql);
    $this->db->bind($stmt, ':lamaran_id', $lamaran_id);
    $this->db->execute($stmt);
    return $this->db->fetch($stmt);
  }
 
  public function addLamaran(int $user_id, int $lowongan_id, string $cv_path, $video_path) {
    if (empty($user_id) || empty($lowongan_id) || empty($cv_path)) {
      throw new Exception("Required fields can't be empty");
    }
    $sql = 'INSERT INTO lamaran(user_id, lowongan_id, cv_path, video_path) VALUES (:user_id, :lowongan_id, :cv_path, :video_path)';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':user_id', $user_id);
    $this->db->bind($statement, ':lowongan_id', $lowongan_id);
    $this->db->bind($statement, ':cv_path', $cv_path);
    $this->db->bind($statement, ':video_path', $video_path);
    try {
      $this->db->execute($statement);
      return $this->db->lastInsertId();
    } catch (Exception $e) {
      throw new Exception('Failed to add lamaran');
    }
  }

  public function updateStatusLamaran(int $lamaran_id, string $new_status, $status_reason) {
    if (empty($lamaran_id) || empty($new_status)) {
      throw new Exception("Required fields can't be empty");
    }
    $sql = "UPDATE lamaran SET status = :new_status, status_reason = :status_reason WHERE lamaran_id = :lamaran_id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':new_status', $new_status);
    $this->db->bind($statement, ':status_reason', $status_reason);
    $this->db->bind($statement, ':lamaran_id', $lamaran_id);
    $this->db->execute($statement);
    return 0;
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

  public function getLamaranData(int $lamaran_id, int $company_id) {
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
}