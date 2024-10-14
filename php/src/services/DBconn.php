<?php
class DBconn {
  private static $instance = null;
  private $pdo;
  private $host = 'localhost';
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
      die("Connection failed: " . $e->getMessage());
    }
  }

  private function __clone() {}

  private function __wakeup() {}

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
      die("Query failed: " . $e->getMessage());
    }
  }

  public function prepare($sql) {
    try {
      return $this->pdo->prepare($sql);
    } catch (PDOException $e) {
      die("Prepare failed: " . $e->getMessage());
    }
  }

  public function execute($statement, $parameters = []) {
    try {
      return $statement->execute($parameters);
    } catch (PDOException $e) {
      die("Execution failed: " . $e->getMessage());
    }
  }

  public function fetchAll($statement) {
    try {
      return $statement->fetchAll();
    } catch (PDOException $e) {
      die("Fetch failed: " . $e->getMessage());
    }
}
  public function fetch($statement) {
    try {
      return $statement->fetch();
    } catch (PDOException $e) {
      die("Fetch failed: " . $e->getMessage());
    }
  }

  public function fetchColumn($statement, $columnNumber = 0) {
    try {
      return $statement->fetchColumn($columnNumber);
    } catch (PDOException $e) {
      die("Fetch failed: " . $e->getMessage());
    }
  }
}