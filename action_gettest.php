<?php
require_once 'models.php';

// Buat objek DataModel
$dataModel = new DataModel();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
$data = $dataModel->getTestById($id);
$gelombangValues = $dataModel->getGelombang();
    $ruangValues = $dataModel->getRuang();
    $ujianValues = $dataModel->getUjian();

$response = [
    'id' => $data['id'],
        'gelombang' => $data['gelombang'], 
        'ruang' => $data['ruang'],
        'jenis_ujian' => $data['jenis_ujian'],
        'tgl_ujian' => $data['tgl_ujian'],
        'jam_mulai' => $data['jam_mulai'],
        'jam_selesai' => $data['jam_selesai'],
        'keterangan' => $data['keterangan'],
        'gelombangValues' => $gelombangValues,
        'ruangValues' => $ruangValues,
        'ujianValues' => $ujianValues
    ];
    echo json_encode($response);
}
?>
