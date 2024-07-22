<?php
class PembayaranController
{
    private $response = [];

    public function __construct()
    {
        $this->response = []; // Reset response
    }
    public function index()
    {
        $models = new pembayaranModel();
        $data = $models->getPembayaran();

        include __DIR__ . '/../Views/others/page_pembayaran.php';
    }

    private function filterData($data, $prodi_id, $kategori)
    {

        $models = new pembayaranModel();
        $startKey = $models->getCountNIM($prodi_id, $kategori);

        $filteredData = array_filter($data, function ($item) use ($prodi_id, $kategori) {
            return $item['prodi_id'] === $prodi_id && $item['kategori'] === $kategori;
        });

        $filteredData = array_values($filteredData);

        foreach ($filteredData as $key => &$item) {
            $nomor_urut = sprintf('%03d', $startKey + $key + 1);
            $item['nomor_urut'] = $nomor_urut;
        }

        return $filteredData;
    }

    private function makeNimALL($datas)
    {
        // Gabungkan data berdasarkan kategori dan jenjang
        foreach ($datas as &$data) {
            $periode = substr($data['periode'], -2);
            $prodi_id = $data['prodi_id'];
            $jenjang = $data['jenjang'];
            $kategori = $data['kategori'];

            // Tentukan format NIM berdasarkan kategori dan jenjang
            if ($jenjang == "RPL") {
                // Handle RPL and Profesi
                $nim = $periode . $prodi_id . "8"; // Format Transfer
            } else if ($jenjang == "Profesi") {
                $nim = $periode . $prodi_id . "3"; // Format Reguler
            } else if ($kategori == "Transfer") {
                $nim = $periode . $prodi_id . "8"; // Format Transfer
            } else if ($kategori == "Reguler") {
                // Treat Reguler students normally
                if ($jenjang == "RPL") {
                    $nim = $periode . $prodi_id . "8"; // Format Transfer
                } else {
                    $nim = $periode . $prodi_id . "3"; // Format Reguler
                }
            }

            $data['nim'] = $nim;
        }

        return $datas;
    }

    public function getNIM()
    {
        $models = new pembayaranModel();
        $data = $models->getNIM();

        include __DIR__ . '/../Views/others/page_nim.php';
    }

    public function generateNIM()
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $data = $input['filteredData'];

        $categories = [
            "01" => ['Reguler' => [], 'Transfer' => []],
            "02" => ['Reguler' => [], 'Transfer' => []],
            "03" => ['Reguler' => [], 'Transfer' => []],
            "04" => ['Reguler' => [], 'Transfer' => []],
            "05" => ['Reguler' => [], 'Transfer' => []],
            "06" => ['Reguler' => [], 'Transfer' => []],
            "07" => ['Reguler' => [], 'Transfer' => []],
            "08" => ['Reguler' => [], 'Transfer' => []],
            "09" => ['Reguler' => [], 'Transfer' => []],
            "10" => ['Reguler' => [], 'Transfer' => []],
        ];

        foreach ($data as $dt) {
            $prodiId = $dt['prodi_id'];
            $kategori = $dt['kategori'];

            if (isset($categories[$prodiId][$kategori])) {
                $categories[$prodiId][$kategori][] = $dt;
            }
        }

        foreach ($categories as $prodiId => $kategoris) {
            foreach ($kategoris as $kategori => $items) {
                if (!empty($items)) {
                    $nim = $this->makeNimAll($items);
                    $responseKey = $this->getResponseKey($prodiId, $kategori);
                    $this->addToResponse($this->response, $responseKey, $nim);
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($this->response);
    }

    private function getResponseKey($prodiId, $kategori)
    {
        $prodiNames = [
            "01" => "Profesi-Apoteker",
            "02" => "S1/RPL-Farmasi",
            "03" => "D3-Farmasi",
            "04" => "D3-Kebidanan",
            "05" => "S1-Akuntansi",
            "06" => "S1-Hukum",
            "07" => "S1-IlmuKomunikasi",
            "08" => "S1-Manajemen",
            "09" => "S1-Informatika",
            "10" => "S1-SistemInformasi"
        ];

        return $prodiNames[$prodiId] . $kategori;
    }


    private function addToResponse(&$response, $key, $data)
    {
        $models = new pembayaranModel();
        if (!empty($data)) {
            $result = $models->saveNIM($data);
            $response[$key] = $result;
        }
    }
}
