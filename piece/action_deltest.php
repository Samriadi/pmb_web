
<?php
include 'models.php';
$dataModel = new DataModel();


// DELETE
$id = $_GET['id'];
$dataModel->deleteTest($id);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
