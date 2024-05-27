<?php
require_once __DIR__ . '/../models/eduPeriodeModel.php';


class eduPeriodeController {
	public function index() {
        $models = new eduPeriodeModel();   
        $data = $models->getPeriode();

		foreach ($data as $dt): 
			$recid = $dt->recid;
			$jenjang = $dt->Jenjang;
			$periode = $dt->Periode;
			$fromDate = $dt->fromDate;
			$toDate = $dt->toDate;
			$keterangan = $dt->Keterangan;
			$status = $dt->status;
		endforeach;

		include __DIR__ . '/../views/pages/page_eduPeriode/index.php';
    }

    public function add() {
        $models = new eduPeriodeModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $jenjang = $_POST['jenjang'];
			$periode = $_POST['periode'];
			$fromDate = $_POST['fromDate'];
			$toDate = $_POST['toDate'];
			$keterangan = $_POST['keterangan'];
			$status = $_POST['status'];

			$models->addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status);

            echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

	public function edit($id) {

		$models = new eduPeriodeModel();   
		
		$data = $models->getPeriodeById($id);
		
		$response = [
			'recid' => $data['recid'],
			'jenjang' => $data['Jenjang'],
			'periode' => $data['Periode'], 
			'fromDate' => $data['fromDate'],
			'toDate' => $data['toDate'],
			'keterangan' => $data['Keterangan'],
			'status' => $data['status'],
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
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	
		exit();
	}
	
}

		



