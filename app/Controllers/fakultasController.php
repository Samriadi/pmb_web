<?php
require_once __DIR__ . '/../models/fakultasModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class fakultasController {
	public function index() {
		try {
			$models = new fakultasModel();   
	
			$data = $models->getFakultas();
			if ($data === false) {
				throw new Exception('Failed to retrieve fakultas data');
			}
	
			// Mengirimkan data dan varData ke view
			include __DIR__ . '/../views/others/page_fakultas.php';
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
	

    public function save() {
		try {
			$models = new fakultasModel(); 
	
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['varname'], $_POST['varvalue'], $_POST['varothers'], $_POST['parent'])) {
					$varname = $_POST['varname'];
					$varvalue = $_POST['varvalue'];
					$varothers = $_POST['varothers'];
					$parent = $_POST['parent'];
	
					$models->add($varname, $varvalue, $varothers, $parent);
					log_activity('ADD Fakultas'); 
	
					echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
				} else {
					throw new Exception('Missing required parameters');
				}
			} else {
				throw new Exception('Invalid request method');
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
	

	public function add() {
		try {
			$models = new varOptiontModel();   
	
			$kampusValues = $models->getVarByName('Kampus');
	
			if ($kampusValues === false) {
				throw new Exception('Failed to retrieve variable options');
			}
	
			$response = [
				'status_code' => 200,
				'status' => 'success',
				'kampusValues' => $kampusValues,
			];
	
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'status' => 'error',
				'message' => $e->getMessage()
			];
		}
	
		echo json_encode($response);
	}
	

    public function edit() {

		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$var = isset($_GET['var']) ? $_GET['var'] : null;

		try {
			$models = new fakultasModel();   
	
			$data = $models->getVarById($id);
			if ($data === false) {
				throw new Exception('Failed to retrieve variable data');
			}
	
			$kampusValues = $models->getVarByName($var);
			if ($kampusValues === false) {
				throw new Exception('Failed to retrieve kampus values');
			}
	
			$response = [
				'status_code' => 200,
				'status' => 'success',
				'recid' => $data['recid'],
				'var_value' => $data['var_value'],
				'var_others' => $data['var_others'],
				'parent' => $data['parent'],
				'kampusValues' => $kampusValues
			];
	
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'status' => 'error',
				'message' => $e->getMessage()
			];
		}
	
		echo json_encode($response);
		exit;
	}
	

	public function update() {
		try {
			$models = new fakultasModel();   
	
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$recid = $_POST['recid'] ?? '';
				$varvalue = $_POST['varvalue'] ?? '';
				$varothers = $_POST['varothers'] ?? '';
				$parent = $_POST['parent'] ?? '';
	
				if (empty($recid) || empty($varvalue) || empty($varothers) || empty($parent)) {
					throw new Exception('Missing required parameters');
				}
	
				$models->updateVar($recid, $varvalue, $varothers, $parent);
				log_activity('EDIT Fakultas'); 
	
				echo json_encode(['status' => 'success', 'message' => 'Record Updated']);
			} else {
				throw new Exception('Invalid request method');
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
	


}

       