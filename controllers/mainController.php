<?php
require_once __DIR__ . '/../models/mainModel.php';

class mainController {

	public function dashboard() {
        $models = new mainModel();   
        $test = $models->getCountTest();

        foreach ($test as $dt): 
			$jumlah_data = $dt->jumlah_data;
		endforeach;

        $var = $models->getCountVar();

        foreach ($var as $dt): 
			$jumlah_data = $dt->jumlah_data;
		endforeach;

		include __DIR__ . '/../views/pages/page_dashboard/index.php';

    }

    
}
   
	
	