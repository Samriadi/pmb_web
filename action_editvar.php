<?php
require_once 'models.php';

// Buat objek DataModel
$dataModel = new DataModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recid = $_POST['recid'];
    $varname = $_POST['varname'];
    $varvalue = $_POST['varvalue'];
    $varothers = $_POST['varothers'];
    $catatan = $_POST['catatan'];
    $parent = $_POST['parent'];

    // Panggil metode updateVar() melalui objek DataModel
    $dataModel->updateVar($recid, $varname, $varvalue, $varothers, $catatan, $parent);

    echo "Data Berhasil Diupdate";
}
?>
