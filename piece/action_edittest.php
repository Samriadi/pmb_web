<?php
require_once 'models.php';

// Buat objek DataModel
$dataModel = new DataModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $gelombang = $_POST['gelombang'];
    $ruang = $_POST['ruang'];
    $jenis_ujian = $_POST['jenis_ujian'];
    $tgl_ujian = $_POST['tgl_ujian'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $keterangan = $_POST['keterangan'];

    // Panggil metode updateVar() melalui objek DataModel
    $dataModel->updateTest($id, $gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan);

    echo "Data Berhasil Diupdate";
}
?>
