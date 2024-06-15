<?php
require_once __DIR__ . '/../models/eduTestModel.php';


class eduTestController
{
	public function index()
	{
		try {
			$models = new eduTestModel();
			$data = $models->getTest();

			if ($data === false) {
				throw new Exception('Failed to retrieve test data');
			}


			include __DIR__ . '/../Views/others/page_jadwalTest.php';
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'status' => 'error',
				'message' => $e->getMessage()
			];
			echo json_encode($response);
		}
	}


	public function add()
	{
		try {
			$models = new eduTestModel();

			$gelombangValues = $models->getGelombang();
			if ($gelombangValues === false) {
				throw new Exception('Failed to retrieve gelombang values');
			}

			$ruangValues = $models->getRuang();
			if ($ruangValues === false) {
				throw new Exception('Failed to retrieve ruang values');
			}

			$ujianValues = $models->getUjian();
			if ($ujianValues === false) {
				throw new Exception('Failed to retrieve ujian values');
			}

			$response = [
				'status_code' => 200,
				'status' => 'success',
				'gelombangValues' => $gelombangValues,
				'ruangValues' => $ruangValues,
				'ujianValues' => $ujianValues
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
			$models = new eduTestModel();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$gelombang = $_POST['gelombang'] ?? '';
				$ruang = $_POST['ruang'] ?? '';
				$jenis_ujin = $_POST['jenis_ujin'] ?? '';
				$keterangan = $_POST['keterangan'] ?? '';

				if (empty($gelombang) || empty($ruang) || empty($jenis_ujin)) {
					throw new Exception('Missing required parameters');
				}

				$models->addTest($gelombang, $ruang, $jenis_ujin, $keterangan);
				log_activity('ADD edu test');

				echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
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
			$models = new eduTestModel();

			$data = $models->getTestById($id);
			if ($data === false) {
				throw new Exception('Failed to retrieve test data');
			}

			$gelombangValues = $models->getGelombang();
			if ($gelombangValues === false) {
				throw new Exception('Failed to retrieve gelombang values');
			}

			$ruangValues = $models->getRuang();
			if ($ruangValues === false) {
				throw new Exception('Failed to retrieve ruang values');
			}

			$ujianValues = $models->getUjian();
			if ($ujianValues === false) {
				throw new Exception('Failed to retrieve ujian values');
			}

			$response = [
				'status_code' => 200,
				'status' => 'success',
				'id' => $data['id'],
				'gelombang' => $data['gelombang'],
				'ruang' => $data['ruang'],
				'jenis_ujin' => $data['jenis_ujin'],
				'keterangan' => $data['keterangan'],
				'gelombangValues' => $gelombangValues,
				'ruangValues' => $ruangValues,
				'ujianValues' => $ujianValues
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
			$models = new eduTestModel();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$id = $_POST['id'] ?? '';
				$gelombang = $_POST['gelombang'] ?? '';
				$ruang = $_POST['ruang'] ?? '';
				$jenis_ujin = $_POST['jenis_ujin'] ?? '';
				$keterangan = $_POST['keterangan'] ?? '';

				if (empty($id) || empty($gelombang) || empty($ruang) || empty($jenis_ujin)) {
					throw new Exception('Missing required parameters');
				}

				$models->updateTest($id, $gelombang, $ruang, $jenis_ujin, $keterangan);
				log_activity('EDIT edu test');

				echo json_encode(['status' => 'success', 'message' => 'Record Updated']);
			} else {
				throw new Exception('Invalid request method');
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}


	public function delete()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

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
