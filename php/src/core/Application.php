<?php
namespace app\core;

use Exception;

class Application {
  public static Application $app;

  public Router $router;
  public Request $request;
  public Response $response;

  public function __construct() {
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
  }

  public function run() {
    try {
      $this->router->resolve();
    } catch (Exception $e) {
      echo $this->response->jsonEncodes(500, ['message' => $e->getMessage()]);  
    }
  }
}