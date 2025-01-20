<?php

class Router
{
  private $routes = [];

  public function get($uri, $controller)
  {
    $this->addRoute('GET', $uri, $controller);
  }

  public function post($uri, $controller)
  {
    $this->addRoute('POST', $uri, $controller);
  }

  private function addRoute($method, $uri, $controller)
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller
    ];
  }

  public function dispatch()
  {
    $requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestedMethod = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $route) {
      if ($route['uri'] === $requestedUri && $route['method'] === $requestedMethod) {
        list($controller, $method) = explode('@', $route['controller']);
        if (class_exists($controller) && method_exists($controller, $method)) {
          call_user_func([new $controller, $method]);
          return;
        } else {
          http_response_code(404);
          echo 'Controladora ou método não encontrado';
          return;
        }
      }
    }

    http_response_code(404);
    echo 'Página não encontrada';
  }
}