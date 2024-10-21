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
    return $this->db->lastInsertId();
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

  public function insertAttachment(int $lowongan_id, $file) {
    foreach($file as $file_name) {
      $sql = "INSERT INTO lowongan_attachment(lowongan_id, file_path) VALUES(:lowongan_id, :files)";
      $statement = $this->db->prepare($sql);
      $this->db->bind($statement, ':lowongan_id', $lowongan_id);
      $this->db->bind($statement, ':files', $file_name);
      $ok = $this->db->execute($statement);
      if (!$ok) {
          throw new Exception("Database error: Unable to execute query.");
      }
    }
  } 

  public function queryUsersIdFromLowonganId(int $id) {
    $sql = "SELECT company_id FROM lowongan WHERE lowongan_id = :id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id", $id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to execute query.");
    }
    $res = $this->db->fetchAll($statement);
    $data = [];
    foreach ($res as $row) {
      $singular = [
        'company_id' => $row['company_id'],
      ];
      array_push($data, $singular);
    }
    return $data;
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

  public function queryDeleteAttachmentById(int $id) {
    $sql = 'DELETE FROM lowongan_attachment WHERE lowongan_id = :id';
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

  public function queryCompanies(int $id) {
    $sql = "SELECT nama FROM users WHERE user_id = $id";
    $statement = $this->db->prepare($sql);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetch($statement);
    $company = $res['nama'];
    return $company;
  }

  public function queryAppliedById(int $lowongan_id, int $user_id) {
    $sql = "SELECT cv_path, video_path, status FROM lamaran WHERE lowongan_id = :lowongan_id AND user_id = :user_id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":lowongan_id", $lowongan_id);
    $this->db->bind($statement, ":user_id", $user_id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetch($statement);
    if (!$res) {
      return;
    }
    $cv_path = $res['cv_path'];
    $video_path = $res['video_path'];
    $status = $res['status'];
    $data = [
      'cv_path' => $cv_path,
      'video_path' => $video_path,
      'status' => $status
    ];
    return $data;
  }

  public function queryFilePathByLowonganId(int $lowongan_id) {
    $sql = "SELECT file_path FROM lowongan_attachment WHERE lowongan_id = :lowongan_id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":lowongan_id", $lowongan_id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetchAll($statement);
    if (!$res) {
      return;
    }
    $data = [];
    foreach ($res as $row) {
      array_push($data, $row['file_path']);
    }
    return $data;
  }
}