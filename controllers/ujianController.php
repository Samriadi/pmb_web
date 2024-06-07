<?php
require_once __DIR__ . '/../models/ujianModel.php';


class ujianController {
	public function index() {
        $models = new ujianModel();   
        $data = $models->getUjian();

		include __DIR__ . '/../views/pages/page_ujian/index.php';
    }
   
    
	
}


