<?php
session_start();
$_SESSION['user_id'] = 4;

date_default_timezone_set('Asia/Makassar');

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Helpers/Function.php';
require_once __DIR__ . '/../app/Core/Database.php';

require_once __DIR__ . '/../app/Controllers/eduTestController.php';
require_once __DIR__ . '/../app/Controllers/varOptionController.php';
require_once __DIR__ . '/../app/Controllers/eduPeriodeController.php';
require_once __DIR__ . '/../app/Controllers/userController.php';

require_once __DIR__ . '/../app/Helpers/function.php';

$router = new Router();

$router->add('/', 'mainController', 'dashboard');
// Definisi rute

//install
$router->add('/data', 'installController', 'data');
$router->add('/install', 'installController', 'install');
$router->add('/install/save', 'installController', 'save');
$router->add('/optional', 'varOptionController', 'optional');
$router->add('/optional/add', 'varOptionController', 'addOptional');

//user
$router->add('/user', 'userController', 'index');
$router->add('/user/add', 'userController', 'add');
$router->add('/user/save', 'userController', 'save');
$router->add('/user/edit', 'userController', 'edit');
$router->add('/user/update', 'userController', 'update');
$router->add('/user/delete', 'userController', 'delete');

//edu test
$router->add('/test', 'eduTestController', 'index');
$router->add('/test/add', 'eduTestController', 'add');
$router->add('/test/save', 'eduTestController', 'save');
$router->add('/test/edit', 'eduTestController', 'edit');
$router->add('/test/update', 'eduTestController', 'update');
$router->add('/test/delete', 'eduTestController', 'delete');

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
$router->add('/var/edit', 'varOptionController', 'edit');
$router->add('/var/update', 'varOptionController', 'update');
$router->add('/var/delete', 'varOptionController', 'delete');

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
$router->add('/prodi/edit', 'prodiController', 'edit');
$router->add('/prodi/update', 'prodiController', 'update');

//exam
$router->add('/ujian', 'ujianController', 'index');
$router->add('/ujian/upload', 'ujianController', 'upload');
$router->add('/ujian/download', 'ujianController', 'download');

//item
$router->add('/testCard', 'mainController', 'testCard');
$router->add('/logs', 'mainController', 'logs');

// helps
$router->add('/help', 'mainController', 'help');
$router->add('/help/get', 'mainController', 'getHelp');


$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';

$router->dispatch($url);
