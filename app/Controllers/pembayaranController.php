<?php
class PembayaranController
{
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

        $models = new pembayaranModel();
        $data = $input['filteredData'];

        $dataApotekerReguler = $dataApotekerTransfer = [];
        $dataS1FarmasiReguler = $dataS1FarmasiTransfer = [];
        $dataD3FarmasiReguler = $dataD3FarmasiTransfer = [];
        $dataKebidananReguler = $dataKebidananTransfer = [];
        $dataAkuntansiReguler = $dataAkuntansiTransfer = [];
        $dataHukumReguler = $dataHukumTransfer = [];
        $dataIlmuKomunikasiReguler = $dataIlmuKomunikasiTransfer = [];
        $dataManajemenReguler = $dataManajemenTransfer = [];
        $dataInformatikaReguler = $dataInformatikaTransfer = [];
        $dataSistemInformasiReguler = $dataSistemInformasiTransfer = [];

        foreach ($data as $dt) {
            switch ($dt['prodi_id']) {
                case "01":
                    if ($dt['kategori'] == "Reguler") {
                        $dataApotekerReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataApotekerTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "02":
                    if ($dt['kategori'] == "Reguler") {
                        $dataS1FarmasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataS1FarmasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "03":
                    if ($dt['kategori'] == "Reguler") {
                        $dataD3FarmasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataD3FarmasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "04":
                    if ($dt['kategori'] == "Reguler") {
                        $dataKebidananReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataKebidananTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "05":
                    if ($dt['kategori'] == "Reguler") {
                        $dataAkuntansiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataAkuntansiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "06":
                    if ($dt['kategori'] == "Reguler") {
                        $dataHukumReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataHukumTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "07":
                    if ($dt['kategori'] == "Reguler") {
                        $dataIlmuKomunikasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataIlmuKomunikasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "08":
                    if ($dt['kategori'] == "Reguler") {
                        $dataManajemenReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataManajemenTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "09":
                    if ($dt['kategori'] == "Reguler") {
                        $dataInformatikaReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataInformatikaTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
                case "10":
                    if ($dt['kategori'] == "Reguler") {
                        $dataSistemInformasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    } elseif ($dt['kategori'] == "Transfer") {
                        $dataSistemInformasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                    }
                    break;
            }
        }

        if (!empty($dataS1FarmasiReguler)) {
            $NimS1FarmasiRegular = $this->makeNimAll($dataS1FarmasiReguler);
            $models->saveNIM($NimS1FarmasiRegular);
        }

        if (!empty($dataS1FarmasiTransfer)) {
            $NimS1FarmasiTransfer = $this->makeNimAll($dataS1FarmasiTransfer);
            $models->saveNIM($NimS1FarmasiTransfer);
        }

        if (!empty($dataApotekerReguler)) {
            $NimApotekerReguler = $this->makeNimAll($dataApotekerReguler);
            $models->saveNIM($NimApotekerReguler);
        }

        if (!empty($dataApotekerTransfer)) {
            $NimApotekerTransfer = $this->makeNimAll($dataApotekerTransfer);
            $models->saveNIM($NimApotekerTransfer);
        }

        if (!empty($dataD3FarmasiReguler)) {
            $NimD3FarmasiReguler = $this->makeNimAll($dataD3FarmasiReguler);
            $models->saveNIM($NimD3FarmasiReguler);
        }

        if (!empty($dataD3FarmasiTransfer)) {
            $NimD3FarmasiTransfer = $this->makeNimAll($dataD3FarmasiTransfer);
            $models->saveNIM($NimD3FarmasiTransfer);
        }

        if (!empty($dataKebidananReguler)) {
            $NimKebidananReguler = $this->makeNimAll($dataKebidananReguler);
            $models->saveNIM($NimKebidananReguler);
        }

        if (!empty($dataKebidananTransfer)) {
            $NimKebidananTransfer = $this->makeNimAll($dataKebidananTransfer);
            $models->saveNIM($NimKebidananTransfer);
        }

        if (!empty($dataAkuntansiReguler)) {
            $NimAkuntansiReguler = $this->makeNimAll($dataAkuntansiReguler);
            $models->saveNIM($NimAkuntansiReguler);
        }

        if (!empty($dataAkuntansiTransfer)) {
            $NimAkuntansiTransfer = $this->makeNimAll($dataAkuntansiTransfer);
            $models->saveNIM($NimAkuntansiTransfer);
        }

        if (!empty($dataHukumReguler)) {
            $NimHukumReguler = $this->makeNimAll($dataHukumReguler);
            $models->saveNIM($NimHukumReguler);
        }

        if (!empty($dataHukumTransfer)) {
            $NimHukumTransfer = $this->makeNimAll($dataHukumTransfer);
            $models->saveNIM($NimHukumTransfer);
        }

        if (!empty($dataIlmuKomunikasiReguler)) {
            $NimIlmuKomunikasiReguler = $this->makeNimAll($dataIlmuKomunikasiReguler);
            $models->saveNIM($NimIlmuKomunikasiReguler);
        }

        if (!empty($dataIlmuKomunikasiTransfer)) {
            $NimIlmuKomunikasiTransfer = $this->makeNimAll($dataIlmuKomunikasiTransfer);
            $models->saveNIM($NimIlmuKomunikasiTransfer);
        }

        if (!empty($dataManajemenReguler)) {
            $NimManajemenReguler = $this->makeNimAll($dataManajemenReguler);
            $models->saveNIM($NimManajemenReguler);
        }

        if (!empty($dataManajemenTransfer)) {
            $NimManajemenTransfer = $this->makeNimAll($dataManajemenTransfer);
            $models->saveNIM($NimManajemenTransfer);
        }

        if (!empty($dataInformatikaReguler)) {
            $NimInformatikaReguler = $this->makeNimAll($dataInformatikaReguler);
            $models->saveNIM($NimInformatikaReguler);
        }

        if (!empty($dataInformatikaTransfer)) {
            $NimInformatikaTransfer = $this->makeNimAll($dataInformatikaTransfer);
            $models->saveNIM($NimInformatikaTransfer);
        }

        if (!empty($dataSistemInformasiReguler)) {
            $NimSistemInformasiReguler = $this->makeNimAll($dataSistemInformasiReguler);
            $models->saveNIM($NimSistemInformasiReguler);
        }

        if (!empty($dataSistemInformasiTransfer)) {
            $NimSistemInformasiTransfer = $this->makeNimAll($dataSistemInformasiTransfer);
            $models->saveNIM($NimSistemInformasiTransfer);
        }
    }
}
