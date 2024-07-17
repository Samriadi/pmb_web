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

    private function makeNim($datas)
    {
        foreach ($datas as &$data) {
            $periode = substr($data['periode'], -2);
            $prodi_id = $data['prodi_id'];
            $no_urut = $data['nomor_urut'];
            $kategori = $data['kategori'];

            if ($kategori == "Reguler") {
                $nim = $periode . $prodi_id . "3" . $no_urut;
            } else if ($kategori == "Transfer") {
                $nim = $periode . $prodi_id . "8" . $no_urut;
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
            $NimS1FarmasiRegular = $this->makeNim($dataS1FarmasiReguler);
            $models->saveNIM($NimS1FarmasiRegular);
        }

        if (!empty($dataS1FarmasiTransfer)) {
            $NimS1FarmasiTransfer = $this->makeNim($dataS1FarmasiTransfer);
            $models->saveNIM($NimS1FarmasiTransfer);
        }

        if (!empty($dataApotekerReguler)) {
            $NimApotekerReguler = $this->makeNim($dataApotekerReguler);
            $models->saveNIM($NimApotekerReguler);
        }

        if (!empty($dataApotekerTransfer)) {
            $NimApotekerTransfer = $this->makeNim($dataApotekerTransfer);
            $models->saveNIM($NimApotekerTransfer);
        }

        if (!empty($dataD3FarmasiReguler)) {
            $NimD3FarmasiReguler = $this->makeNim($dataD3FarmasiReguler);
            $models->saveNIM($NimD3FarmasiReguler);
        }

        if (!empty($dataD3FarmasiTransfer)) {
            $NimD3FarmasiTransfer = $this->makeNim($dataD3FarmasiTransfer);
            $models->saveNIM($NimD3FarmasiTransfer);
        }

        if (!empty($dataKebidananReguler)) {
            $NimKebidananReguler = $this->makeNim($dataKebidananReguler);
            $models->saveNIM($NimKebidananReguler);
        }

        if (!empty($dataKebidananTransfer)) {
            $NimKebidananTransfer = $this->makeNim($dataKebidananTransfer);
            $models->saveNIM($NimKebidananTransfer);
        }

        if (!empty($dataAkuntansiReguler)) {
            $NimAkuntansiReguler = $this->makeNim($dataAkuntansiReguler);
            $models->saveNIM($NimAkuntansiReguler);
        }

        if (!empty($dataAkuntansiTransfer)) {
            $NimAkuntansiTransfer = $this->makeNim($dataAkuntansiTransfer);
            $models->saveNIM($NimAkuntansiTransfer);
        }

        if (!empty($dataHukumReguler)) {
            $NimHukumReguler = $this->makeNim($dataHukumReguler);
            $models->saveNIM($NimHukumReguler);
        }

        if (!empty($dataHukumTransfer)) {
            $NimHukumTransfer = $this->makeNim($dataHukumTransfer);
            $models->saveNIM($NimHukumTransfer);
        }

        if (!empty($dataIlmuKomunikasiReguler)) {
            $NimIlmuKomunikasiReguler = $this->makeNim($dataIlmuKomunikasiReguler);
            $models->saveNIM($NimIlmuKomunikasiReguler);
        }

        if (!empty($dataIlmuKomunikasiTransfer)) {
            $NimIlmuKomunikasiTransfer = $this->makeNim($dataIlmuKomunikasiTransfer);
            $models->saveNIM($NimIlmuKomunikasiTransfer);
        }

        if (!empty($dataManajemenReguler)) {
            $NimManajemenReguler = $this->makeNim($dataManajemenReguler);
            $models->saveNIM($NimManajemenReguler);
        }

        if (!empty($dataManajemenTransfer)) {
            $NimManajemenTransfer = $this->makeNim($dataManajemenTransfer);
            $models->saveNIM($NimManajemenTransfer);
        }

        if (!empty($dataInformatikaReguler)) {
            $NimInformatikaReguler = $this->makeNim($dataInformatikaReguler);
            $models->saveNIM($NimInformatikaReguler);
        }

        if (!empty($dataInformatikaTransfer)) {
            $NimInformatikaTransfer = $this->makeNim($dataInformatikaTransfer);
            $models->saveNIM($NimInformatikaTransfer);
        }

        if (!empty($dataSistemInformasiReguler)) {
            $NimSistemInformasiReguler = $this->makeNim($dataSistemInformasiReguler);
            $models->saveNIM($NimSistemInformasiReguler);
        }

        if (!empty($dataSistemInformasiTransfer)) {
            $NimSistemInformasiTransfer = $this->makeNim($dataSistemInformasiTransfer);
            $models->saveNIM($NimSistemInformasiTransfer);
        }
    }
}
