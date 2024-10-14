<?php
class Router {
  protected $controller;
  protected $method;
  protected $params = [];
  public function __construct() {
    $this->method = 'index';
    
    $url = $this->parseUrl();

    $controllerPart = $url[0] ?? null;
    if ($controllerPart) {
      $controllerClass = ucfirst($controllerPart) . 'Controller';
      $controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';
      
      if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $this->controller = new $controllerClass();
      } else {
        $this->handleError(404, "Controller not found.");
        return;
      }
    } else {
      // header('Location: /home/');
      echo "FAIL";
      return;
    }
    unset($url[0]);

    $methodPart = $url[1] ?? null;
    if ($methodPart && method_exists($this->controller, $methodPart)) {
      $this->method = $methodPart;
    } else if ($methodPart) {
      $this->handleError(404, "Method not found.");
      return;
    }
    unset($url[1]);

    $this->params = !empty($url) ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  private function parseUrl() {
    if (isset($_SERVER['PATH_INFO'])) {
      $url = trim($_SERVER['PATH_INFO'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      return explode('/', $url);
    }
    return [];
  }

  private function handleError($code, $message) {
    http_response_code($code);
    echo $message;
  }
}