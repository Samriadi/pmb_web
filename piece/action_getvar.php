<?php
require_once 'models.php';

// Buat objek DataModel
$dataModel = new DataModel();

if (isset($_GET['recid'])) {
    $recid = $_GET['recid'];
    $data = $dataModel->getVarById($recid);
    echo json_encode($data);
}
?>
