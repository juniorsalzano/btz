<?php

require_once __DIR__ . '/../Auth/Auth.php';

class Router
{
  private $routes = [];

  public function get($uri, $controller, $authRequired = false)
  {
    $this->addRoute('GET', $uri, $controller, $authRequired);
  }

  public function post($uri, $controller, $authRequired = false)
  {
    $this->addRoute('POST', $uri, $controller, $authRequired);
  }

  private function addRoute($method, $uri, $controller, $authRequired)
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'authRequired' => $authRequired
    ];
  }

  public function dispatch()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === $method) {
        if ($route['authRequired'] && !Auth::check()) {
          header('Location: /login');
          exit;
        }

        list($controller, $action) = explode('@', $route['controller']);
        $controller = new $controller;
        $controller->$action();
        return;
      }
    }

    http_response_code(404);
    echo '404 Not Found';
  }
}
