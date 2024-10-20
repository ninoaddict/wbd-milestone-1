<?php
namespace app\models;
use app\db\DBconn;
use Exception;

class LowonganModel {
  private $db;

  public function __construct() {
    $this->db = DBconn::getInstance();
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
}