<?php
require_once 'models.php';

// Buat objek DataModel
$dataModel = new DataModel();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $dataModel->getTestById($id);
    echo json_encode($data);
}
?>
