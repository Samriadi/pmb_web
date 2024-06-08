<?php
require_once __DIR__ . '/../models/eduPeriodeModel.php';
require_once __DIR__ . '/../models/varOptionModel.php';


class eduPeriodeController
{
	public function index()
	{
		try {
			$models = new eduPeriodeModel();
			$data = $models->getPeriode();

			if ($data === false) {
				throw new Exception('Failed to retrieve periods');
			}

			$result = [];
			foreach ($data as $dt) {
				$recid = $dt->recid;
				$jenjang = $dt->Jenjang;
				$periode = $dt->Periode;
				$fromDate = $dt->fromDate;
				$toDate = $dt->toDate;
				$keterangan = $dt->Keterangan;
				$status = $dt->status;

				$is_in_tagihan = $models->getPeriodeIsInTagihan($recid, $periode);
				if ($is_in_tagihan === false) {
					throw new Exception('Failed to check if period is in billing for recid ' . $recid);
				}

				$result[] = [
					'recid' => $recid,
					'jenjang' => $jenjang,
					'periode' => $periode,
					'fromDate' => $fromDate,
					'toDate' => $toDate,
					'keterangan' => $keterangan,
					'status' => $status,
					'is_in_tagihan' => $is_in_tagihan
				];
			}

			include __DIR__ . '/../views/pages/page_eduPeriode/index.php';
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'status' => 'error',
				'message' => $e->getMessage()
			];
			echo json_encode($response);
		}
	}


	public function add($jenjang)
	{
		try {
			if (empty($jenjang)) {
				throw new Exception('Missing required parameter');
			}

			$models = new varOptiontModel();

			$jenjangValues = $models->getVarByName($jenjang);

			if ($jenjangValues === false) {
				throw new Exception('Failed to retrieve variable options');
			}

			$response = [
				'status_code' => 200,
				'status' => 'success',
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
			$models = new eduPeriodeModel();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['jenjang'], $_POST['periode'], $_POST['fromDate'], $_POST['toDate'], $_POST['keterangan'], $_POST['status'])) {
					$jenjang = $_POST['jenjang'];
					$periode = $_POST['periode'];
					$fromDate = $_POST['fromDate'];
					$toDate = $_POST['toDate'];
					$keterangan = $_POST['keterangan'];
					$status = $_POST['status'];

					$models->addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status);
					log_activity('ADD Periode');

					$response = ['status_code' => 200, 'status' => 'success', 'message' => 'New record added'];
				} else {
					throw new Exception('Missing required parameters');
				}
			} else {
				throw new Exception('Invalid request method');
			}
		} catch (Exception $e) {
			$response = ['status_code' => 500, 'status' => 'error', 'message' => $e->getMessage()];
		}

		echo json_encode($response);
	}

	public function edit($id, $var)
	{
		try {
			$eduPeriodeModel = new eduPeriodeModel();
			$varOptionModel = new varOptiontModel();

			$data = $eduPeriodeModel->getPeriodeById($id);
			$jenjangValues = $varOptionModel->getVarByName($var);

			if (!$data) {
				throw new Exception('Data tidak ditemukan.');
			}

			$response = [
				'recid' => $data['recid'],
				'jenjang' => $data['Jenjang'],
				'periode' => $data['Periode'],
				'fromDate' => $data['fromDate'],
				'toDate' => $data['toDate'],
				'keterangan' => $data['Keterangan'],
				'status' => $data['status'],
				'jenjangValues' => $jenjangValues,
				'status_code' => 200,
				'message' => 'Data berhasil diambil'
			];
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'message' => $e->getMessage()
			];
		}

		echo json_encode($response);
	}

	public function lastPeriod($jenjang)
	{
		try {
			$models = new eduPeriodeModel();
			$data = $models->getLastPeriode($jenjang);

			if (!$data) {
				throw new Exception('Data tidak ditemukan.');
			}

			$response = [
				'lastPeriod' => $data['lastPeriod'],
				'status_code' => 200,
				'message' => 'Data berhasil diambil'
			];
		} catch (Exception $e) {
			$response = [
				'status_code' => 500,
				'message' => $e->getMessage()
			];
		}

		echo json_encode($response);
		exit;
	}


	public function update()
	{
		$models = new eduPeriodeModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$recid = $_POST['recid'] ?? '';
				$jenjang = $_POST['jenjang'] ?? '';
				$periode = $_POST['periode'] ?? '';
				$fromDate = $_POST['fromDate'] ?? '';
				$toDate = $_POST['toDate'] ?? '';
				$keterangan = $_POST['keterangan'] ?? '';
				$status = $_POST['status'] ?? '';

				if (empty($recid) || empty($jenjang) || empty($periode) || empty($fromDate) || empty($toDate) || empty($status)) {
					throw new Exception('All fields are required.');
				}

				$models->updatePeriode($recid, $jenjang, $periode, $fromDate, $toDate, $keterangan, $status);
				log_activity('EDIT Periode');

				echo json_encode(['status' => 'success', 'message' => 'Periode updated successfully']);
			} catch (Exception $e) {
				// Log the error message for debugging
				log_activity('EDIT Periode Error: ' . $e->getMessage());

				// Return an error response
				echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}


	public function delete()
	{
		$models = new eduPeriodeModel();

		$recid = isset($_GET['recid']) ? $_GET['recid'] : null;

		if ($recid) {
			$models->deletePeriode($recid);
			log_activity('DELETE Periode');
		} else {
			echo "Invalid ID";
			return;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
}
