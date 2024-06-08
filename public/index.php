<?php
// public/index.php
require_once __DIR__ . '/../core/route.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../controllers/eduTestController.php';
require_once __DIR__ . '/../controllers/varOptionController.php';
require_once __DIR__ . '/../controllers/userController.php';
require_once __DIR__ . '/../controllers/installController.php';
require_once __DIR__ . '/../controllers/prodiController.php';

require_once __DIR__ . '/../helpers/function.php';

$router = new Router();

$router->add('/', 'mainController', 'dashboard');

//install
$router->add('/install', 'installController', 'index');
$router->add('/install-add', 'installController', 'add');
$router->add('/install/save', 'installController', 'save');
$router->add('/optional', 'varOptionController', 'optional');
$router->add('/optional/add', 'varOptionController', 'addOptional');

//user
$router->add('/user', 'userController', 'index');
$router->add('/user/add', 'userController', 'add');
$router->add('/user/save', 'userController', 'save');
$router->add('/user/edit/{id}', 'userController', 'edit');
$router->add('/user/update', 'userController', 'update');
$router->add('/user/delete/{id}', 'userController', 'delete');

//edu test
$router->add('/test', 'eduTestController', 'index');
$router->add('/test/add', 'eduTestController', 'add');
$router->add('/test/save', 'eduTestController', 'save');
$router->add('/test/edit/{id}', 'eduTestController', 'edit');
$router->add('/test/update', 'eduTestController', 'update');
$router->add('/test/delete/{id}', 'eduTestController', 'delete');

//edu Periode
$router->add('/periode', 'eduPeriodeController', 'index');
$router->add('/periode/add/{var}', 'eduPeriodeController', 'add');
$router->add('/periode/save', 'eduPeriodeController', 'save');
$router->add('/periode/lastPeriod/{jenjang}', 'eduPeriodeController', 'lastPeriod');
$router->add('/periode/edit/{id}/include/{var}', 'eduPeriodeController', 'edit');
$router->add('/periode/update', 'eduPeriodeController', 'update');
$router->add('/periode/delete', 'eduPeriodeController', 'delete');

//var option
$router->add('/var', 'varOptionController', 'index');
$router->add('/var/add', 'varOptionController', 'add');
$router->add('/var/edit/{id}', 'varOptionController', 'edit');
$router->add('/var/update', 'varOptionController', 'update');
$router->add('/var/delete/{id}', 'varOptionController', 'delete');

//var option -> fakultas
$router->add('/fakultas', 'fakultasController', 'index');
$router->add('/fakultas/add', 'fakultasController', 'add');
$router->add('/fakultas/save', 'fakultasController', 'save');
$router->add('/fakultas/edit/{id}/include/{var}', 'fakultasController', 'edit');
$router->add('/fakultas/update', 'fakultasController', 'update');

//var option -> prodi
$router->add('/prodi', 'prodiController', 'index');
$router->add('/prodi/add', 'prodiController', 'add');
$router->add('/prodi/save', 'prodiController', 'save');
$router->add('/prodi/edit/{id}', 'prodiController', 'edit');
$router->add('/prodi/update', 'prodiController', 'update');

//exam
$router->add('/ujian', 'ujianController', 'index');
$router->add('/ujian/upload', 'ujianController', 'upload');



//item
$router->add('/testCard', 'mainController', 'testCard');
$router->add('/logs', 'mainController', 'logs');



//
$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';

$router->dispatch($url);
