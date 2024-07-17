<?php
class testPendaftarController
{
    public function index()
    {
        $models = new testPendaftarModel();
        $PendaftarVerified = $models->getPendaftarTerverifikasi();
        $JadwalTestPendaftar = $models->getTestPendaftar();


        include __DIR__ . '/../Views/others/page_testPendaftar.php';
    }

    public function pendaftarVerified()
    {
        $models = new testPendaftarModel();
        $PendaftarVerified = $models->getPendaftarTerverifikasi();


        include __DIR__ . '/../Views/others/page_pendaftarVerified.php';
    }

    public function add()
    {
        $models = new testPendaftarModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tagihan_ids = $_POST['tagihan_id'];
            $test_tanggal = $_POST['test_tanggal'];
            $test_mulai = $_POST['test_mulai'];
            $test_selesai = $_POST['test_selesai'];
            $test_lokasi = $_POST['test_lokasi'];

            // Iterasi melalui array $tagihan_ids
            foreach ($tagihan_ids as $tagihan_id) {
                $models->addTestPendaftar($tagihan_id, $test_tanggal, $test_mulai, $test_selesai, $test_lokasi);
            }

            echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

    public function drop()
    {
        $models = new testPendaftarModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['checkedValues'];

            foreach ($data as $item) {
                $models->dropTestPendaftar($item);
            }

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
}
