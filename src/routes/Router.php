<?php

class Router
{
  private $routes = [];

  public function get($uri, $controller, $authRequired = true)
  {
    $this->addRoute('GET', $uri, $controller, $authRequired);
  }

  public function post($uri, $controller, $authRequired = true)
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
    $requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestedMethod = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $route) {
      if ($route['uri'] === $requestedUri && $route['method'] === $requestedMethod) {
        if ($route['authRequired'] && !$this->isAuthenticated()) {
          header('Location: /login');
          exit;
        }

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

  private function isAuthenticated()
  {
    return isset($_SESSION['user_id']);
  }
}