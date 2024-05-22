<?php
require_once 'database.php'; // Pastikan ini mengarah ke file Database Anda
require_once 'models.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
    $model = new dataModel();
    $uploadResult = $model->uploadBukti($_FILES['file'], $member_id);

    if ($uploadResult !== false) {
        $message = "Upload berhasil! File disimpan di: " . $uploadResult;
    } else {
        $message = "Upload gagal.";
    }
} else {
    $message = "Tidak ada file yang diupload atau member_id tidak disediakan.";
}
echo "<script type='text/javascript'>
        alert('$message');
        window.history.back();
      </script>";
?>
