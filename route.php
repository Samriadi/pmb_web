<?php
class Router {
  private $routes = [];

  public function add($uri, $controller, $method) {
      // Pastikan URI dimulai dengan '/' jika tidak kosong
      $uri = '/' . trim($uri, '/');
      $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
  }

  public function dispatch($requestUri) {
      // Menghapus path proyek dari URI
      $projectPath = '/hewi';
      $uri = str_replace($projectPath, '', $requestUri);
      $uri = '/' . trim($uri, '/'); // Pastikan URI dimulai dengan '/'

      // Debugging: Cetak URI yang diminta

      if (array_key_exists($uri, $this->routes)) {
          $controller = $this->routes[$uri]['controller'];
          $method = $this->routes[$uri]['method'];

          // Debugging: Cetak controller dan method yang akan dipanggil
          // echo "Controller: $controller, Method: $method <br>";

          if (class_exists($controller) && method_exists($controller, $method)) {
              $controllerObj = new $controller();
              $controllerObj->$method();
          } else {
              echo "Controller or Method Not Found! <br>";
          }
      } else {
          echo "Route Not Found! <br>";
      }
  }
}

?>


