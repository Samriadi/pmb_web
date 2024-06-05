<?php
require_once __DIR__ . '/../models/eduPeriodeModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class eduPeriodeController {
	public function index() {
        $models = new eduPeriodeModel();   
        $data = $models->getPeriode();

		$result = [];
		foreach ($data as $dt): 
			$recid = $dt->recid;
			$jenjang = $dt->Jenjang;
			$periode = $dt->Periode;
			$fromDate = $dt->fromDate;
			$toDate = $dt->toDate;
			$keterangan = $dt->Keterangan;
			$status = $dt->status;

        	$is_in_tagihan = $models->getPeriodeIsInTagihan($recid,$periode);

			$result[] = [
			'recid' => $recid,
			'jenjang' => $jenjang,
			'periode' => $periode,
			'fromDate' => $fromDate,
			'toDate' => $toDate,
			'keterangan' => $keterangan,
			'status' => $status,
			'is_in_tagihan' => $is_in_tagihan
		];

		endforeach;

		include __DIR__ . '/../views/pages/page_eduPeriode/index.php';
    }

	public function add($jenjang) {
		if (empty($jenjang)) {
			echo json_encode(['status' => 'error', 'message' => 'Missing required parameter']);
			return;
		}
	
		$models = new varOptiontModel();   
	
		$jenjangValues = $models->getVarByName($jenjang);
	
		if ($jenjangValues === false) {
			echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve variable options']);
			return;
		}
	
		$response = [
			'jenjangValues' => $jenjangValues,
		];
	
		echo json_encode($response);
	}
	

	public function save() {
		$models = new eduPeriodeModel();   
	
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['jenjang'], $_POST['periode'], $_POST['fromDate'], $_POST['toDate'], $_POST['keterangan'], $_POST['status'])) {
				$jenjang = $_POST['jenjang'];
				$periode = $_POST['periode'];
				$fromDate = $_POST['fromDate'];
				$toDate = $_POST['toDate'];
				$keterangan = $_POST['keterangan'];
				$status = $_POST['status'];
	
				$models->addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status);
				log_activity('ADD Periode'); 

	
				echo json_encode(['status' => 'success', 'message' => 'New record added']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}
	
	

	public function edit($id, $var) {

		$eduPeriodeModel = new eduPeriodeModel();   
		$varOptionModel = new varOptiontModel();  
		
		$data = $eduPeriodeModel->getPeriodeById($id);
        $jenjangValues = $varOptionModel->getVarByName($var);
		
		$response = [
			'recid' => $data['recid'],
			'jenjang' => $data['Jenjang'],
			'periode' => $data['Periode'], 
			'fromDate' => $data['fromDate'],
			'toDate' => $data['toDate'],
			'keterangan' => $data['Keterangan'],
			'status' => $data['status'],
			'jenjangValues' => $jenjangValues
		];
		
        echo json_encode($response);
	}

	

	public function lastPeriod($jenjang) {
        $models = new eduPeriodeModel();   

        $data = $models->getLastPeriode($jenjang);

		$response = [
			'lastPeriod' => $data['lastPeriod'],
		];
		echo json_encode($response);
		exit;

    }

	public function update() {
        $models = new eduPeriodeModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   			$recid = $_POST['recid'] ?? '';
			$jenjang = $_POST['jenjang'] ?? '';
            $periode = $_POST['periode'] ?? '';
            $fromDate = $_POST['fromDate'] ?? '';
            $toDate = $_POST['toDate'] ?? '';
            $keterangan = $_POST['keterangan'] ?? '';
            $status = $_POST['status'] ?? '';


            $models->updatePeriode($recid, $jenjang, $periode, $fromDate, $toDate, $keterangan, $status);
			log_activity('EDIT Periode'); 


        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

	public function delete($id) {
		$models = new eduPeriodeModel();
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}
	
		$models->deletePeriode($id);
		log_activity('DELETE Periode'); 

		header('Location: ' . $_SERVER['HTTP_REFERER']); 
	
		exit();
	}
	
}


	
	






