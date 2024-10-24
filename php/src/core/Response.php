<?php
namespace app\core;

class Response {
  public function __construct() {}
  public function setStatusCode($code) {
    http_response_code($code);
  }

  public function jsonEncodes($statusCode, $data) {
    $this->setStatusCode($statusCode);
    header('Content-Type: application/json');
    return json_encode($data);
  }

  public function redirect($url) {
    header("Location: $url");
  }
}