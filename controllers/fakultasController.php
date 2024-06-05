<?php
require_once __DIR__ . '/../models/fakultasModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class fakultasController {
	public function index() {
		$models = new fakultasModel();   

		$data = $models->getFakultas();
		
		// Mengirimkan data dan varData ke view
		include __DIR__ . '/../views/pages/page_fakultas/index.php';
	}

    public function save() {
        $models = new fakultasModel();   
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

    public function add() {
	
		$models = new varOptiontModel();   
	
		$kampusValues = $models->getVarByName('Kampus');
	
		if ($kampusValues === false) {
			echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve variable options']);
			return;
		}
	
		$response = [
			'kampusValues' => $kampusValues,
		];
	
		echo json_encode($response);
	}

    public function edit($id, $var) {

		$models = new fakultasModel();   
		
		$data = $models->getVarById($id);
        $kampusValues = $models->getVarByName($var);
		
		$response = [
			'recid' => $data['recid'],
			'var_value' => $data['var_value'],
			'var_others' => $data['var_others'],
			'parent' => $data['parent'],
			'kampusValues' => $kampusValues

		];
		
        echo json_encode($response);
		exit;
	}

	public function update() {
        $models = new fakultasModel();   
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

       