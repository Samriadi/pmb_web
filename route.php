<?php
class Router {
  private $routes = [];

  public function add($uri, $controller, $method) {
      $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
  }

public function dispatch($requestUri) {
    // Memisahkan path URI dari query string
    $uri = parse_url($requestUri, PHP_URL_PATH);

    if (array_key_exists($uri, $this->routes)) {
      $controller = $this->routes[$uri]['controller'];
      $method = $this->routes[$uri]['method'];

      if (class_exists($controller) && method_exists($controller, $method)) {
          $controllerObj = new $controller();
          $controllerObj->$method();
      } else {
          echo "Not Found!";
      }
    } else {
      echo "Sory, Not Found!";
    }
}
}
?>
