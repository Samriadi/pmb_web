<?php
require_once __DIR__ . '/../models/ujianModel.php';


class ujianController
{
    public function index()
    {
        $models = new ujianModel();
        $data = $models->getUjian();

        include __DIR__ . '/../Views/others/page_ujian.php';
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
                    $models->uploadCSV($no_ujian, $kelulusan);
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

    public function download()
    {
        $models = new ujianModel();
        $data = $models->downloadCSV();

        if ($data) {
            $filename = "data_export.csv";
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename=' . $filename);

            $output = fopen('php://output', 'w');

            $title = ['No Ujian', 'Nama Lengkap', 'Kelulusan'];

            $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $delimiter = ',';
            if (strpos($user_agent, 'Windows') !== false) {
                $delimiter = ';';
            }

            fputcsv($output, $title, $delimiter);

            $field = ['no_ujian', 'NamaLengkap', 'kelulusan'];
            foreach ($data as $row) {
                $value = [];
                foreach ($field as $column) {
                    if ($column === 'no_ujian') {
                        $value[] = sprintf('="%s"', isset($row[$column]) ? $row[$column] : '');
                    } else {
                        $value[] = isset($row[$column]) ? $row[$column] : '';
                    }
                }

                fputcsv($output, $value, $delimiter);
            }

            fclose($output);
            exit();
        } else {
            echo "Tidak ada data ditemukan.";
        }
    }
}
