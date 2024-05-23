<?php
require_once __DIR__ . '/../models/eduTestModel.php';


class varOptionController {
	public function var_option() {
		$models = new dataModel();   
        $data = $models->getVar();

		foreach ($data as $dt): 
			$recid = $dt->recid;
			$var_name = $dt->var_name;
			$var_value = $dt->var_value;
			$var_others = $dt->var_others;
			$catatan = $dt->catatan;
			$parent = $dt->parent;
		endforeach;
		include __DIR__ . '/../views/page_varOption/index.php';

    }

}
   