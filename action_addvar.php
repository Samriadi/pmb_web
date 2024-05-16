
<?php
include 'models.php';
$dataModel = new DataModel();


// ADD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recid = $_POST['recid'];
    $varname = $_POST['varname'];
    $varvalue = $_POST['varvalue'];
    $varothers = $_POST['varothers'];
    $catatan = $_POST['catatan'];
    $parent = $_POST['parent'];

    // Panggil fungsi addVar() melalui objek DataModel
    $dataModel->addVar($recid, $varname, $varvalue, $varothers, $catatan, $parent);

    echo "New record created successfully";
}

// DELETE
$recid = $_GET['recid'];
$dataModel->deleteVar($recid);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
