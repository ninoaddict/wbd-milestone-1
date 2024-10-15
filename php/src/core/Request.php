<?php
namespace app\core;

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
}