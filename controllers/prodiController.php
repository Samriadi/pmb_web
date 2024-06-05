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
}