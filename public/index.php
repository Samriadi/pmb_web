<?php
// public/index.php
require_once __DIR__ . '/../core/route.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../controllers/eduTestController.php';
require_once __DIR__ . '/../controllers/varOptionController.php';

$router = new Router();

$router->add('/', 'mainController', 'dashboard');

//edu test
$router->add('/test', 'eduTestController', 'index');
$router->add('/test/add', 'eduTestController', 'add');
$router->add('/test/save', 'eduTestController', 'save');
$router->add('/test/edit/{id}', 'eduTestController', 'edit');
$router->add('/test/update', 'eduTestController', 'update');
$router->add('/test/delete/{id}', 'eduTestController', 'delete');

//edu Periode
$router->add('/periode', 'eduPeriodeController', 'index');
$router->add('/periode/add', 'eduPeriodeController', 'add');


//var option
$router->add('/var', 'varOptionController', 'index');
$router->add('/var/add', 'varOptionController', 'add');
$router->add('/var/edit/{id}', 'varOptionController', 'edit');
$router->add('/var/update', 'varOptionController', 'update');
$router->add('/var/delete/{id}', 'varOptionController', 'delete');

//
$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';

$router->dispatch($url);
?>
