<?php
require_once __DIR__ . '/../models/installModel.php';

class installController {

	public function install() {
		include __DIR__ . '/../views/pages/page_install/index.php';

    }

    public function save() {
        $models = new installModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $namaLengkapKampus = $_POST['namaLengkapKampus'];
            $namaSingkat = $_POST['namaSingkat'];
            $jalan = $_POST['jalan'];
            $kota = $_POST['kota'];
            $provinsi = $_POST['provinsi'];
            $negara = $_POST['negara'];
            $tingkatan = $_POST['tingkatan'];
            $kodeWarnaUtama = $_POST['kodeWarnaUtama'];

            $optionalFields = [];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'optionalField') !== false && strpos($key, 'Name') !== false) {
                    $fieldName = $value;
                    $fieldValueKey = str_replace('Name', 'Value', $key);
                    if (isset($_POST[$fieldValueKey])) {
                        $fieldValue = $_POST[$fieldValueKey];
                        $optionalFields[$fieldName] = $fieldValue;
                    }
                }
            };

            $optionalFieldsJson = json_encode($optionalFields);

            $models->save($namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $tingkatan, $kodeWarnaUtama, $optionalFieldsJson);

        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }


    
}
   
	
	