<?php
require_once __DIR__ . '/../models/varOptionModel.php';


class varOptionController {
	public function index() {
		$models = new varOptiontModel();   
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

	public function add() {
        $models = new varOptiontModel();   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
			$recid = $_POST['recid'];
			$varname = $_POST['varname'];
			$varvalue = $_POST['varvalue'];
			$varothers = $_POST['varothers'];
			$catatan = $_POST['catatan'];
			$parent = $_POST['parent'];

			$models->addVar($recid, $varname, $varvalue, $varothers, $catatan, $parent);

            echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
        } 
		else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

	public function delete($id) {
		$models = new DataModel();
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}
	
		$models->deleteVar($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	
		exit();
	}

}
   