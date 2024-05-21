
<?php
include 'models.php';
$dataModel = new DataModel();


// ADD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gelombang = $_POST['gelombang'];
    $ruang = $_POST['ruang'];
    $jenis_ujian = $_POST['jenis_ujian'];
    $tgl_ujian = $_POST['tgl_ujian'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $keterangan = $_POST['keterangan'];

    $dataModel->addTest($gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan);

    echo "New record created successfully";
}

?>
