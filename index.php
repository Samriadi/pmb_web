<?php
require_once 'rout.php';
require_once 'dtbs.php';
require_once 'controller.php';
require_once 'models.php';

$router = new Router();

$subdirectory = 'app/edu';
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

if (substr($requestUri, 0, strlen($subdirectory)) === $subdirectory) {
    $requestUri = substr($requestUri, strlen($subdirectory));
}
$requestUri = trim($requestUri, '/');

$router->add('', 'mainController', 'index');
$router->add('info', 'mainController', 'hotNews');
$router->add('save', 'mainController', 'save');

$router->dispatch($requestUri);
?>