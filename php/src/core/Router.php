<?php
namespace app\core;

use Exception;

class Router {
  private array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }

  public function get(string $url, $handler) {
    $this->routes[$url]['get'] = $handler;
  }

  public function post(string $url, $handler) {
    $this->routes[$url]['post'] = $handler;
  }

  public function put(string $url, $handler) {
    $this->routes[$url]['put'] = $handler;
  }

  public function delete(string $url, $handler) {
    $this->routes[$url]['delete'] = $handler;
  }

  public function findHandler() {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    if (isset($this->routes[$path][$method])) {
      return $this->routes[$path][$method];
    }

    foreach (array_keys($this->routes) as $route) {
      $pattern = "@^" . preg_replace('/(:\w+)/', '(\w+)', $route) . "$@";
      if (preg_match($pattern, $path, $matches)) {
        if (isset($this->routes[$route][$method])) {
          array_shift($matches);
          $this->request->setParams($matches);
          return $this->routes[$route][$method];
        }
        throw new Exception("Page not found", 404);
      }
    }
    throw new Exception("Page not found", 404);
  }

  public function resolve() {
    $handler = $this->findHandler();
    if (is_array($handler)) {
      $controller = new $handler[0];
      $handler[0] = $controller;
    }
    return call_user_func($handler, $this->request);
  }
}