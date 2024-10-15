<?php
namespace app\core;

use Exception;

class Request {
  private string $path;
  private string $method;
  private array $params;

  public function __construct() {
    $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    $this->path = $_SERVER['PATH_INFO'] ?? '/';
  }

  public function getPath(): string {
    return $this->path;
  }

  public function getMethod(): string {
    return $this->method;
  }

  public function getParams(): array {
    return $this->params;
  }

  public function setParams(array $params) {
    $this->params = $params;
  }

  public function getQuery(): array  {
    $data = [];
    if ($this->method === 'get') {
      foreach ($_GET as $key => $value) {
        $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    return $data;
  }

  public function getBody(): array {
    $data = [];

    switch ($this->method) {
      case 'post':
        foreach ($_POST as $key => $value) {
          $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        break;
      case 'put':
        $rawInput = file_get_contents('php://input');
        $decodedInput = json_decode($rawInput, true);
        if (json_last_error() === JSON_ERROR_NONE) {
          foreach ($decodedInput as $key => $value) {
              $data[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
          }
        } else {
            throw new Exception('Invalid JSON in request body');
        }
        break;
    }
    return $data;
  }
}