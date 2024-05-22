
<?php
include 'models.php';
$dataModel = new DataModel();


// DELETE
$recid = $_GET['recid'];
$dataModel->deleteVar($recid);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
