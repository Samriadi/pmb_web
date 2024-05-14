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

// Memeriksa apakah koneksi berhasil dengan memeriksa hasil kueri

// Contoh penggunaan Router
$router = new Router();

$subdirectory = 'hewi-edu/hewi'; // Path sub-direktori yang ingin diabaikan
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Menghapus sub-direktori dari URI permintaan jika ditemukan
if (strpos($requestUri, $subdirectory) === 0) {
    $requestUri = substr($requestUri, strlen($subdirectory));
}

// Lanjutkan dengan memproses URI yang sudah dimodifikasi
$requestUri = trim($requestUri, '/');

$router->add('', 'mainController', 'bukti');


$router->dispatch($requestUri);
?>