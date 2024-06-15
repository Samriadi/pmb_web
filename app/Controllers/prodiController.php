<?php
require_once __DIR__ . '/../models/prodiModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class prodiController
{
	public function index()
	{
		try {
			$models = new prodiModel();

			$data = $models->getProdi();
			if ($data === false) {
				throw new Exception('Failed to retrieve prodi data');
			}

			include __DIR__ . '/../Views/others/page_prodi.php';
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

	public function add()
	{
		try {
			$models = new varOptiontModel();

			$fakultasValues = $models->getVarByName('Fakultas');
			if ($fakultasValues === false) {
				throw new Exception('Failed to retrieve Fakultas variable options');
			}

			$jenjangValues = $models->getVarByName('Jenjang');
			if ($jenjangValues === false) {
				throw new Exception('Failed to retrieve Jenjang variable options');
			}

			$response = [
				'status_code' => 200,
				'status' => 'success',
				'fakultasValues' => $fakultasValues,
				'jenjangValues' => $jenjangValues,
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

	public function save()
	{
		try {
			$models = new prodiModel();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['varname'], $_POST['varvalue'], $_POST['varothers'], $_POST['parent'])) {
					$varname = $_POST['varname'];
					$varvalue = $_POST['varvalue'];
					$varothers = $_POST['varothers'];
					$parent = $_POST['parent'];

					$models->add($varname, $varvalue, $varothers, $parent);
					log_activity('ADD Prodi');

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

	public function edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		try {
			$models = new prodiModel();

			$data = $models->getVarById($id);
			if ($data === false) {
				throw new Exception('Failed to retrieve variable data');
			}

			$jenjangValues = $models->getVarByName('Jenjang');
			if ($jenjangValues === false) {
				throw new Exception('Failed to retrieve Jenjang variable options');
			}

			$fakultasValues = $models->getVarByName('Fakultas');
			if ($fakultasValues === false) {
				throw new Exception('Failed to retrieve Fakultas variable options');
			}

			$response = [
				'status_code' => 200,
				'status' => 'success',
				'recid' => $data['recid'],
				'var_value' => $data['var_value'],
				'var_others' => $data['var_others'],
				'parent' => $data['parent'],
				'fakultasValues' => $fakultasValues,
				'jenjangValues' => $jenjangValues,
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

	public function update()
	{
		try {
			$models = new prodiModel();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$recid = $_POST['recid'] ?? '';
				$varvalue = $_POST['varvalue'] ?? '';
				$varothers = $_POST['varothers'] ?? '';
				$parent = $_POST['parent'] ?? '';

				if (empty($recid) || empty($varvalue) || empty($varothers) || empty($parent)) {
					throw new Exception('Missing required parameters');
				}

				$models->updateVar($recid, $varvalue, $varothers, $parent);
				log_activity('EDIT Prodi');

				echo json_encode(['status' => 'success', 'message' => 'Record Updated']);
			} else {
				throw new Exception('Invalid request method');
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
