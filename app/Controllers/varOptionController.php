<?php
require_once __DIR__ . '/../models/varOptionModel.php';



class varOptionController
{
	public function index()
	{
		$models = new varOptiontModel();
		$data = $models->getVar();

		foreach ($data as $dt) :
			$recid = $dt->recid;
			$var_name = $dt->var_name;
			$var_value = $dt->var_value;
			$var_others = $dt->var_others;
			$catatan = $dt->catatan;
			$parent = $dt->parent;
		endforeach;
		include __DIR__ . '/../Views/others/page_varOption.php';
	}

	public function add()
	{
		$models = new varOptiontModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$varname = $_POST['varname'];
			$varvalue = $_POST['varvalue'];
			$varothers = $_POST['varothers'];
			$catatan = $_POST['catatan'];
			$parent = $_POST['parent'];

			$models->addVar($varname, $varvalue, $varothers, $catatan, $parent);
			log_activity('ADD varoption');

			echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	public function edit()
	{

		$id = isset($_GET['recid']) ? $_GET['recid'] : null;

		$models = new varOptiontModel();
		$data = $models->getVarById($id);

		if ($data) {
			$response = [
				'recid' => $data->recid,
				'var_name' => $data->var_name,
				'var_value' => $data->var_value,
				'var_others' => $data->var_others,
				'catatan' => $data->catatan,
				'parent' => $data->parent,
			];
		} else {
			$response = [
				'error' => 'Data not found'
			];
		}
		echo json_encode($response);
		exit;
	}

	public function update()
	{
		$models = new varOptiontModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$recid = $_POST['recid'];
			$varname = $_POST['varname'];
			$varvalue = $_POST['varvalue'];
			$varothers = $_POST['varothers'];
			$catatan = $_POST['catatan'];
			$parent = $_POST['parent'];

			$models->updateVar($recid, $varname, $varvalue, $varothers, $catatan, $parent);
			log_activity('EDIT varoption');

			echo json_encode(['status' => 'success', 'message' => 'New Record Updated']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	public function delete()
	{

		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$models = new varOptiontModel();

		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}

		$models->deleteVar($id);
		log_activity('DELETE varoption');

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	//Optional
	public function optional()
	{

		$models = new varOptiontModel();
		$data = $models->getVarByName('optional');

		include __DIR__ . '/../Views/others/page_installOptional.php';
	}
	public function addOptional()
	{
		$models = new varOptiontModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$varname = $_POST['var_name'];

			$optionalFields = [];
			foreach ($_POST as $key => $value) {
				if (strpos($key, 'optionalField') !== false && strpos($key, 'Name') !== false) {
					$fieldName = $value;
					$fieldValueKey = str_replace('Name', 'Value', $key);
					if (isset($_POST[$fieldValueKey])) {
						$fieldValue = $_POST[$fieldValueKey];
						$optionalFields[$fieldName] = $fieldValue;
					}
				}
			};

			$optionalFieldsJson = json_encode($optionalFields);


			$models->addOptional($varname, $optionalFieldsJson);
			log_activity('ADD Var Optional');
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}
}
