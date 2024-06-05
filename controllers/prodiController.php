<?php
require_once __DIR__ . '/../models/prodiModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class prodiController {
	public function index() {
		$models = new prodiModel();   

		$data = $models->getProdi();
	
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
    public function edit($id) {

		$models = new prodiModel();   
		
		$data = $models->getVarById($id);
		$jenjangValues = $models->getVarByName('Jenjang');
		$fakultasValues = $models->getVarByName('Fakultas');

		$response = [
			'recid' => $data['recid'],
			'var_value' => $data['var_value'],
			'var_others' => $data['var_others'],
			'parent' => $data['parent'],
			'fakultasValues' => $fakultasValues,
			'jenjangValues' => $jenjangValues,

		];
		
        echo json_encode($response);
		exit;
	}
    public function update() {
        $models = new prodiModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   			$recid = $_POST['recid'];
			$varvalue = $_POST['varvalue'];
			$varothers = $_POST['varothers'];
			$parent = $_POST['parent'];


            $models->updateVar($recid, $varvalue, $varothers, $parent);

            echo json_encode(['status' => 'success', 'message' => 'New Record Updated']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

}