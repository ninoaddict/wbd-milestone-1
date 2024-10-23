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
        'company_id' => $company_id,
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

  public function queryCompanyDetail(int $id) {
    $sql = "SELECT nama, lokasi, about FROM users JOIN company_detail ON users.user_id = company_detail.user_id WHERE users.user_id = :id";
    $statement = $this->db->prepare($sql);
    $this->db->bind($statement, ":id", $id);
    $ok = $this->db->execute($statement);
    if (!$ok) {
      throw new Exception("Database error: Unable to delete query.");
    }
    $res = $this->db->fetch($statement);
    $comps = [
      "nama" => $res['nama'],
      "lokasi" => $res['lokasi'],
      "about" => $res['about']
    ];
    return $comps;
  }

  public function queryAppliedById(int $lowongan_id, int $user_id) {
    $sql = "SELECT cv_path, video_path, status, status_reason FROM lamaran WHERE lowongan_id = :lowongan_id AND user_id = :user_id";
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
    $status_reason = $res['status_reason'];
    $data = [
      'cv_path' => $cv_path,
      'video_path' => $video_path,
      'status' => $status,
      'status_reason' => $status_reason
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

  public function getAllLowongan() {
    $sql = "SELECT lowongan_id, nama, lokasi, posisi, jenis_pekerjaan, jenis_lokasi, is_open, EXTRACT(DAY FROM (NOW() - created_at)) as days_before, created_at
    FROM lowongan l
    INNER JOIN users u ON l.company_id = u.user_id
    INNER JOIN company_detail cd ON cd.user_id = u.user_id
    ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    $this->db->execute($stmt);
    return $this->db->fetchAll($stmt);
  }

  public function getFilterLowongan($query = '', $page = 1, $limit = 10, $order = "desc", $jobType = [], $locationType = []) {
    if ($page < 1 || $limit < 1 ) {
      throw new Exception("Bad request exception", 400);
    }

    $skip = max(0, $limit * ($page - 1));
    $take = max(1, $limit);
    $orderBy = ($order === "asc") ? "asc" : "desc";

    $filters = [];
    $params = [];

    if (!empty($query)) {
      $filters[] = "(posisi iLIKE :query OR nama iLIKE :query)";
      $params[':query'] = "%" . $query . "%";
    }

    if (!empty($jobType)) {
      $jobTypePlaceholders = [];
      foreach ($jobType as $index => $type) {
        $placeholder = ":jobType" . $index;
        $jobTypePlaceholders[] = $placeholder;
        $params[$placeholder] = $type;
      }
      $filters[] = "jenis_pekerjaan IN (" . implode(',', $jobTypePlaceholders) . ")";
    }

    if (!empty($locationType)) {
      $locationPlaceholders = [];
      foreach ($locationType as $index => $type) {
        $placeholder = ":locationType" . $index;
        $locationPlaceholders[] = $placeholder;
        $params[$placeholder] = $type;
      }
      $filters[] = "jenis_lokasi IN (" . implode(',', $locationPlaceholders) . ")";
    }
    
    $where = '';
    if (!empty($filters)) {
      $where = "WHERE " . implode(" AND ", $filters);
    }

    $sql_num_page = "SELECT COUNT(*) as row_num
    FROM lowongan l
    INNER JOIN users u ON l.company_id = u.user_id
    INNER JOIN company_detail cd ON cd.user_id = u.user_id
    $where";

    $stmt_num_page = $this->db->prepare($sql_num_page);
    $this->db->execute($stmt_num_page, $params);
    $numRowRaw = $this->db->fetch($stmt_num_page);
    $numRow = $numRowRaw['row_num'];
    $numPage = (int) ceil($numRow / $take);

    $sql = "SELECT lowongan_id, nama, lokasi, posisi, jenis_pekerjaan, jenis_lokasi, is_open, EXTRACT(DAY FROM (NOW() - created_at)) AS days_before, created_at
    FROM lowongan l
    INNER JOIN users u ON l.company_id = u.user_id
    INNER JOIN company_detail cd ON cd.user_id = u.user_id
    $where
    ORDER BY created_at $orderBy
    OFFSET :skip LIMIT :take";

    $params[':skip'] = $skip;
    $params[':take'] = $take;

    $stmt = $this->db->prepare($sql);
    $this->db->execute($stmt, $params);
    $jobs = $this->db->fetchAll($stmt);
    $res['jobs'] = $jobs;
    $res['maxPage'] = $numPage;
    return $res;
  }

  public function getFilterLowonganCompany(int $company_id, $query = '', $page = 1, $limit = 10, $order = "desc", $jobType = [], $locationType = []) {
    if ($page < 1 || $limit < 1 ) {
      throw new Exception("Bad request exception", 400);
    }

    $skip = max(0, $limit * ($page - 1));
    $take = max(1, $limit);
    $orderBy = ($order === "asc") ? "asc" : "desc";

    $filters = [];
    $params = [];

    if (!empty($query)) {
      $filters[] = "(posisi iLIKE :query OR nama iLIKE :query)";
      $params[':query'] = "%" . $query . "%";
    }

    if (!empty($jobType)) {
      $jobTypePlaceholders = [];
      foreach ($jobType as $index => $type) {
        $placeholder = ":jobType" . $index;
        $jobTypePlaceholders[] = $placeholder;
        $params[$placeholder] = $type;
      }
      $filters[] = "jenis_pekerjaan IN (" . implode(',', $jobTypePlaceholders) . ")";
    }

    if (!empty($locationType)) {
      $locationPlaceholders = [];
      foreach ($locationType as $index => $type) {
        $placeholder = ":locationType" . $index;
        $locationPlaceholders[] = $placeholder;
        $params[$placeholder] = $type;
      }
      $filters[] = "jenis_lokasi IN (" . implode(',', $locationPlaceholders) . ")";
    }
    
    $where = '';
    if (!empty($filters)) {
      $where = "WHERE " . implode(" AND ", $filters);
    }

    $params[':company_id'] = $company_id;

    $sql_num_page = "SELECT COUNT(*) as row_num
    FROM lowongan l
    INNER JOIN users u ON l.company_id = u.user_id AND u.user_id = :company_id
    INNER JOIN company_detail cd ON cd.user_id = u.user_id
    $where";

    $stmt_num_page = $this->db->prepare($sql_num_page);
    $this->db->execute($stmt_num_page, $params);
    $numRowRaw = $this->db->fetch($stmt_num_page);
    $numRow = $numRowRaw['row_num'];
    $numPage = (int) ceil($numRow / $take);

    $sql = "SELECT lowongan_id, nama, lokasi, posisi, jenis_pekerjaan, jenis_lokasi, is_open, EXTRACT(DAY FROM (NOW() - created_at)) AS days_before, created_at
    FROM lowongan l
    INNER JOIN users u ON l.company_id = u.user_id AND u.user_id = :company_id
    INNER JOIN company_detail cd ON cd.user_id = u.user_id
    $where
    ORDER BY created_at $orderBy
    OFFSET :skip LIMIT :take";

    $params[':skip'] = $skip;
    $params[':take'] = $take;

    $stmt = $this->db->prepare($sql);
    $this->db->execute($stmt, $params);
    $jobs = $this->db->fetchAll($stmt);
    $res['jobs'] = $jobs;
    $res['maxPage'] = $numPage;
    return $res;
  }
}