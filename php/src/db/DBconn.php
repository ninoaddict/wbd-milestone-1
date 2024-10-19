<?php
namespace app\db;

use PDO;
use PDOException;
use Exception;

class DBconn {
  private static $instance = null;
  private $pdo;
  private $host = 'db';
  private $user = 'postgres';
  private $dbname = 'linkedin';
  private $password = 'tubeswbd';
  private function __construct() {
    try {
      $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
      $this->pdo = new PDO($dsn, $this->user, $this->password, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false, 
      ]);
    } catch (PDOException $e) {
      throw new Exception("Connection failed: " . $e->getMessage(), 500);
    }
  }

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function query($sql) {
    try {
      return $this->pdo->query($sql);
    } catch (PDOException $e) {
      throw new Exception("Query failed: " . $e->getMessage(), 500);
    }
  }

  public function prepare($sql) {
    try {
      return $this->pdo->prepare($sql);
    } catch (PDOException $e) {
      throw new Exception("Prepare failed: " . $e->getMessage(), 500);
    }
  }
  public function bind(&$statement, $param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $statement->bindValue($param, $value, $type);
}

  public function execute($statement) {
    try {
      return $statement->execute();
    } catch (PDOException $e) {
      throw new Exception("Execution failed: " . $e->getMessage(), 500);
    }
  }

  public function fetchAll($statement) {
    try {
      return $statement->fetchAll();
    } catch (PDOException $e) {
      throw new Exception("Fetch failed: " . $e->getMessage(), 500);
    }
}
  public function fetch($statement) {
    try {
      return $statement->fetch();
    } catch (PDOException $e) {
      throw new Exception("Fetch failed: " . $e->getMessage(), 500);
    }
  }

  public function fetchColumn($statement, $columnNumber = 0) {
    try {
      return $statement->fetchColumn($columnNumber);
    } catch (PDOException $e) {
      throw new Exception("Fetch failed: " . $e->getMessage(), 500);
    }
  }

  public function lastInsertId() {
    return $this->pdo->lastInsertId();
  }
}