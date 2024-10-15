<?php
namespace app\core;

class Controller {
  public $data;

  public function render(string $path, $data = []) {
    $this->data = $data;
    require_once $path; 
  }
}