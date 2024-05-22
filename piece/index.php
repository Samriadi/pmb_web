<?php
// Mengeksekusi kueri sederhana untuk memeriksa koneksi
require_once 'database.php';
require_once 'route.php';
require_once 'controller.php';
require_once 'models.php';

$db = Database::getInstance();
$query = "SELECT 1";
$stmt = $db->prepare($query);
$stmt->execute();
$router = new Router();

$router->add('/', 'MainController', 'edu_test'); 



// Eksekusi dispatch untuk menangani permintaan
$router->dispatch($_SERVER['REQUEST_URI']);

?>