<?php
// public/index.php
require_once __DIR__ . '/../core/route.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../controllers/eduTestController.php';

$router = new Router();

$router->add('/', 'mainController', 'dashboard');

//edu test
$router->add('/test', 'eduTestController', 'index');
$router->add('/test/add', 'eduTestController', 'add');
$router->add('/test/save', 'eduTestController', 'save');
$router->add('/test/edit/{id}', 'eduTestController', 'edit');
$router->add('/test/update', 'eduTestController', 'update');
$router->add('/test/delete/{id}', 'eduTestController', 'delete');

//
$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';

$router->dispatch($url);
?>
