<?php


class pendaftarController
{
    public function index()
    {
        $models = new pendaftarModel();
        $data = $models->getPendaftar();
        include __DIR__ . '/../Views/others/page_pendaftar.php';
    }

    public function verified(){
        $models = new pendaftarModel();
        $data = $models->getVerified();
        include __DIR__ . '/../Views/others/page_verified.php';
    }

    public function detail(){ 
        $models = new pendaftarModel();
        $id = $_GET['id'];
        $detailData = $models->getDetail($id);
        echo json_encode($detailData);
    }

    public function toggleVerified() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        $model = new pendaftarModel();

        $currentStatus = $model->getVerificationStatus($id);

        $prefix_noUjian = date("m");

        $newStatus = ($currentStatus === "Verified") ? "Unverified" : "Verified";

        if ($newStatus === "Verified") {
            $no_ujian = $prefix_noUjian . "0" . $id;
			$pay_status = "Yes";

        }else {
			$no_ujian = '';
			$pay_status = "No";
		}

        $updateSuccess = $model->updateVerificationStatus($id, $newStatus, $no_ujian, $pay_status);

        header('Content-Type: application/json');
        echo json_encode(['success' => $updateSuccess, 'verified' => $newStatus]);
    }
}
