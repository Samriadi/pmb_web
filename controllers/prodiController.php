<?php
require_once __DIR__ . '/../models/prodiModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class prodiController {
	public function index() {
		$models = new prodiModel();   
		$kampus = new varOptiontModel();   

		$data = $models->getProdi();
		$varData = [];

		foreach ($data as $dt) {
			$varData[$dt->recid] = $kampus->getVarById($dt->parent);  
		}
	
		// Mengirimkan data dan varData ke view
		include __DIR__ . '/../views/pages/page_prodi/index.php';
	}
    public function add() {
	
		$models = new varOptiontModel();   
	
		$fakultasValues = $models->getVarByName('Fakultas');
		$jenjangValues = $models->getVarByName('Jenjang');
	
		if ($fakultasValues === false || $jenjangValues === false) {
			echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve variable options']);
			return;
		}
	
		$response = [
			'fakultasValues' => $fakultasValues,
			'jenjangValues' => $jenjangValues,
		];
	
		echo json_encode($response);
	}
    public function save() {
        $models = new prodiModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
			$varname = $_POST['varname'];
			$varvalue = $_POST['varvalue'];
			$varothers = $_POST['varothers'];
			$parent = $_POST['parent'];

			$models->add($varname, $varvalue, $varothers, $parent);

            echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
}