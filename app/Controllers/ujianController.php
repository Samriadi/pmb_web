<?php
require_once __DIR__ . '/../models/ujianModel.php';


class ujianController
{
    public function index()
    {
        $models = new ujianModel();
        $data = $models->getUjian();

        include __DIR__ . '/../views/others/page_ujian.php';
    }

    public function upload()
    {
        $models = new ujianModel();

        header('Content-Type: application/json');

        if ($_FILES['file']['error'] == UPLOAD_ERR_OK && $_FILES['file']['size'] > 0) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $response = [];
            $isFirstRow = true;

            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }
                $x = count($data);
                if (count($data) >= $x) {
                    $no_ujian = trim($data[0]);
                    $nama = trim($data[1]);
                    $kelulusan = trim($data[2]);

                    $response[] = [
                        'no_ujian' => $no_ujian,
                        'nama' => $nama,
                        'kelulusan' => $kelulusan,
                    ];
                    $models->updateDataFromCSV($no_ujian, $kelulusan);
                } else {
                    $response[] = [
                        'error' => 'Baris tidak valid, jumlah kolom kurang: ' . implode(', ', $data)
                    ];
                }
            }
            fclose($handle);

            echo json_encode([
                'status' => 'success',
                'data' => $response
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam proses upload file.'
            ]);
        }
    }
}
