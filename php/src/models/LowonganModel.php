<?php
namespace app\models;

use app\db\DBconn;
use Exception;

class LowonganModel {
  private $db;
  public function __construct() {
    $this->db = DBconn::getInstance();
  }

  public function insertJob(string $position, string $company, string $loc_type, string $job_type, string $status, string $deskripsi) {
    if (empty($position) || empty($loc_type) || empty($job_type) || empty($status)) {
        throw new Exception("Database error: Unable to execute query.");
      }
    $sql = "SELECT user_id FROM users WHERE nama = :company";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':company', $company);
    $ok = $this->db->execute($statement);
    if (!$ok) {
        throw new Exception("Database error: Unable to execute query.");
    }
    $id = $this->db->fetch($statement);
    $userId = $id ? $id['user_id'] : null;

    $opened = true ? $status === "Open" : false;
    $sql = 'INSERT INTO lowongan(company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) VALUES (:company_id, :position, :deskripsi, :job_type, :loc_type, :opened)';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':company_id', $userId);
    $this->db->bind($statement, ':position', $position);
    $this->db->bind($statement, ':deskripsi', $deskripsi);
    $this->db->bind($statement, ':job_type', $job_type);
    $this->db->bind($statement, ':loc_type', $loc_type);
    $this->db->bind($statement, ':opened', $opened);
    $ok = $this->db->execute($statement);
    if (!$ok) {
    throw new Exception("Database error: Unable to execute query.");
    }
  }
}