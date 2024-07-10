<?php
class testPendaftarController
{
	public function index()
	{
        $models = new testPendaftarModel();
		$PendaftarVerified = $models->getPendaftarTerverifikasi();
		$JadwalTestPendaftar = $models->getTestPendaftar();

        $result = [];

        foreach ($JadwalTestPendaftar as $entry) {
            $key = $entry->test_tanggal . $entry->test_lokasi . $entry->test_mulai . $entry->test_selesai;

            if (!isset($result[$key])) {
                $result[$key] = (object)[
                    'recid' => [],
                    'test_lokasi' => $entry->test_lokasi,
                    'test_memberid' => [],
                    'test_mulai' => $entry->test_mulai,
                    'test_selesai' => $entry->test_selesai,
                    'test_tanggal' => $entry->test_tanggal
                ];
            }

            $result[$key]->recid[] = $entry->recid;
            $result[$key]->test_memberid[] = $entry->test_memberid;
        }

        $mergedDataTestPendaftar = array_values($result);

		include __DIR__ . '/../Views/others/page_testPendaftar.php';
	}

    public function add()
	{
		$models = new testPendaftarModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $member_ids = $_POST['member_id'];
			$test_tanggal = $_POST['test_tanggal'];
			$test_mulai = $_POST['test_mulai'];
			$test_selesai = $_POST['test_selesai'];
			$test_lokasi = $_POST['test_lokasi'];

            // Iterasi melalui array $member_ids
            foreach ($member_ids as $member_id) {
                // Memanggil fungsi addTestPendaftar untuk setiap $member_id
                $models->addTestPendaftar($member_id, $test_tanggal, $test_mulai, $test_selesai, $test_lokasi);
            }

			echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}
   
}
