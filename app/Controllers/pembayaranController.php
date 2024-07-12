<?php
class PembayaranController {
    public function index() {
        $models = new pembayaranModel();
        $data = $models->getPembayaran();

        foreach($data as $dt){
            if($dt['prodi_id'] == "01"){
                if ($dt['kategori'] == "Reguler"){
                    $dataApotekerReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                else if ($dt['kategori'] == "Transfer"){
                    $dataApotekerTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            } 

            if($dt['prodi_id'] == "02"){
                if ($dt['kategori'] == "Reguler"){
                    $dataS1FarmasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataS1FarmasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }
            if($dt['prodi_id'] == "03"){
                if ($dt['kategori'] == "Reguler"){
                    $dataD3FarmasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataD3FarmasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            } 

            if($dt['prodi_id'] == "04"){
                if ($dt['kategori'] == "Reguler"){
                    $dataKebidananReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataKebidananTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }

            if($dt['prodi_id'] == "05"){
                if ($dt['kategori'] == "Reguler"){
                    $dataAkuntansiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataAkuntansiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }
            
            if($dt['prodi_id'] == "06"){
                if ($dt['kategori'] == "Reguler"){
                    $dataHukumReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataHukumTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }

            if($dt['prodi_id'] == "07"){
                if ($dt['kategori'] == "Reguler"){
                    $dataIlmuKomunikasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataIlmuKomunikasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }

            if($dt['prodi_id'] == "08"){
                if ($dt['kategori'] == "Reguler"){
                    $dataManajemenReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataManajemenTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }

            if($dt['prodi_id'] == "09"){
                if ($dt['kategori'] == "Reguler"){
                    $dataInformatikaReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataInformatikaTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }

            if($dt['prodi_id'] == "10"){
                if ($dt['kategori'] == "Reguler"){
                    $dataSistemInformasiReguler = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
                if ($dt['kategori'] == "Transfer"){
                    $dataSistemInformasiTransfer = $this->filterData($data, $dt['prodi_id'], $dt['kategori']);
                }
            }
        }

        $NimS1FarmasiRegular = $this->makeNim($dataS1FarmasiReguler);  
        $NimS1FarmasiTransfer= $this->makeNim($dataS1FarmasiTransfer);  

        include __DIR__ . '/../Views/others/page_pembayaran.php';
    }

    private function filterData($data, $prodi_id, $kategori) {
        $filteredData = array_filter($data, function($item) use ($prodi_id, $kategori) {
            return $item['prodi_id'] === $prodi_id && $item['kategori'] === $kategori;
        });
    
        $filteredData = array_values($filteredData);
    
        foreach ($filteredData as $key => &$item) {
            $nomor_urut = sprintf('%03d', $key + 1); 
            $item['nomor_urut'] = $nomor_urut;
        }
    
        return $filteredData;
    }

    private function makeNim($datas){
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
    
        
}

?>