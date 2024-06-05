<?php
require_once __DIR__ . '/../models/eduTestModel.php';


class eduTestController {
	public function index() {
        $models = new eduTestModel();   
        $data = $models->getTest();

		foreach ($data as $dt): 
			$id = $dt->id;
			$gelombang = $dt->gelombang;
			$ruang = $dt->ruang;
			$jenis_ujian = $dt->jenis_ujian;
			$tgl_ujian = $dt->tgl_ujian;
			$jam_mulai = $dt->jam_mulai;
			$jam_selesai = $dt->jam_selesai;
			$keterangan = $dt->keterangan;
			$status = $dt->status;
		endforeach;

		include __DIR__ . '/../views/pages/page_jadwalTest/index.php';
    }

	public function add() {
        $models = new eduTestModel();   

        $gelombangValues = $models->getGelombang();
		$ruangValues = $models->getRuang();
		$ujianValues = $models->getUjian();

		$response = [
			'gelombangValues' => $gelombangValues,
			'ruangValues' => $ruangValues,
			'ujianValues' => $ujianValues
		];
		echo json_encode($response);
    }

	public function save() {
        $models = new eduTestModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gelombang = $_POST['gelombang'] ?? '';
            $ruang = $_POST['ruang'] ?? '';
            $jenis_ujian = $_POST['jenis_ujian'] ?? '';
            $tgl_ujian = $_POST['tgl_ujian'] ?? '';
            $jam_mulai = $_POST['jam_mulai'] ?? '';
            $jam_selesai = $_POST['jam_selesai'] ?? '';
            $keterangan = $_POST['keterangan'] ?? '';

            $models->addTest($gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan);
			log_activity('ADD edu test'); 

            echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

	public function edit($id) {

		$models = new eduTestModel();   
		
		$data = $models->getTestById($id);
		$gelombangValues = $models->getGelombang();
		$ruangValues = $models->getRuang();
		$ujianValues = $models->getUjian();
		
		$response = [
			'id' => $data['id'],
			'gelombang' => $data['gelombang'], 
			'ruang' => $data['ruang'],
			'jenis_ujian' => $data['jenis_ujian'],
			'tgl_ujian' => $data['tgl_ujian'],
			'jam_mulai' => $data['jam_mulai'],
			'jam_selesai' => $data['jam_selesai'],
			'keterangan' => $data['keterangan'],
			'gelombangValues' => $gelombangValues,
			'ruangValues' => $ruangValues,
			'ujianValues' => $ujianValues
		];
		
        echo json_encode($response);
		exit;
	}

	public function update() {
        $models = new eduTestModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   			$id = $_POST['id'] ?? '';
			$gelombang = $_POST['gelombang'] ?? '';
            $ruang = $_POST['ruang'] ?? '';
            $jenis_ujian = $_POST['jenis_ujian'] ?? '';
            $tgl_ujian = $_POST['tgl_ujian'] ?? '';
            $jam_mulai = $_POST['jam_mulai'] ?? '';
            $jam_selesai = $_POST['jam_selesai'] ?? '';
            $keterangan = $_POST['keterangan'] ?? '';

            $models->updateTest($id, $gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangan);
			log_activity('EDIT edu test'); 

            echo json_encode(['status' => 'success', 'message' => 'New Record Updated']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

	public function delete($id) {
		$models = new eduTestModel();
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}
	
		$models->deleteTest($id);
		log_activity('DELETE edu test'); 

		header('Location: ' . $_SERVER['HTTP_REFERER']);
	
		exit();
	}
	
}


