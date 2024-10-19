<?php
namespace app\models;

use app\db\DBconn;
use Exception;
use app\core\Application;

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

  public function updateJob(string $position, string $company, string $loc_type, string $job_type, string $status, string $deskripsi, int $lowongan_id) {
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
    $sql = 'UPDATE lowongan SET company_id = :company_id,
                                posisi = :position, 
                                deskripsi = :deskripsi, 
                                jenis_pekerjaan = :job_type, 
                                jenis_lokasi = :loc_type, 
                                is_open = :opened
                            WHERE lowongan_id = :lowongan_id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ':company_id', $userId);
    $this->db->bind($statement, ':position', $position);
    $this->db->bind($statement, ':deskripsi', $deskripsi);
    $this->db->bind($statement, ':job_type', $job_type);
    $this->db->bind($statement, ':loc_type', $loc_type);
    $this->db->bind($statement, ':opened', $opened);
    $this->db->bind($statement, ':lowongan_id', $lowongan_id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
    throw new Exception("Database error: Unable to execute query.");
    }
  }

  public function queryDetailsById(int $id) {
    $sql = "SELECT lowongan_id, company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open FROM lowongan WHERE lowongan_id = :id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id",$id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
        throw new Exception("Database error: Unable to execute query.");
    }
    $res = $this->db->fetch($statement);
    $lowongan_id = $res['lowongan_id'];
    $company_id = $res['company_id'];
    $posisi = $res['posisi'];
    $deskripsi = $res['deskripsi'];
    $jenis_pekerjaan = $res['jenis_pekerjaan'];
    $jenis_lokasi = $res['jenis_lokasi'];
    $is_open = $res['is_open'];

    $sql = "SELECT nama FROM users WHERE user_id = :company_id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":company_id", $company_id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
        throw new Exception("Database error: Unable to execute query.");
    }
    $res = $this->db->fetch($statement);
    $company_name = $res['nama'];

    $data = [
        'lowongan_id' => $lowongan_id,
        'company_name' => $company_name,
        'posisi' => $posisi,
        'deskripsi' => $deskripsi,
        'jenis_pekerjaan' => $jenis_pekerjaan,
        'jenis_lokasi' => $jenis_lokasi,
        'is_open' => $is_open
    ];

    return $data;
  }

  public function queryCloseById(int $id) {
    $sql = 'UPDATE lowongan SET is_open = NOT is_open WHERE lowongan_id = :id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id", "$id");
    $ok = $this->db->execute($statement);
    if (!$ok) {
        throw new Exception("Database error: Unable to execute query.");
    }
  }

  public function queryDeleteById(int $id) {
    $sql = 'DELETE FROM lowongan WHERE lowongan_id = :id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id", "$id");
    $ok = $this->db->execute($statement);
    if (!$ok) {
        throw new Exception("Database error: Unable to delete query.");
    }
  }

  public function queryLamaranById(int $id) {
    $sql = 'SELECT lamaran_id, nama, status FROM lamaran JOIN users ON lamaran.user_id = users.user_id WHERE lowongan_id = :id';
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id", $id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetchAll($statement);
    $data = [];
    foreach ($res as $row) {
      $singular = [
        'lamaran_id' => $row['lamaran_id'],
        'nama' => $row['nama'],
        'status' => $row['status']
      ];
      array_push($data, $singular);
    }
    return $data;
  }

  public function queryCompanies() {
    $sql = "SELECT nama FROM users WHERE role = 'company'";
    $statement = $this->db->prepare($sql);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetchAll($statement);
    return $res;
  }
}