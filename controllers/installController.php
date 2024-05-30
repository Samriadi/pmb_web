<?php
require_once __DIR__ . '/../models/installModel.php';

class installController {

	public function index() {
        $models = new installModel();   
        $data = $models->getInstall();

		include __DIR__ . '/../views/pages/page_install/index.php';
    }

    public function add() {
        $models = new installModel();   
        $data = $models->getInstall();

		include __DIR__ . '/../views/pages/page_install/add.php';
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
            $kodeWarnaUtama = $_POST['kodeWarnaUtama'];

 

            $models->save($namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $kodeWarnaUtama);

        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }


    
}
   
	
	