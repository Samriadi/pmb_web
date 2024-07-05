<?php


class pendaftarController
{
    public function index()
    {
        $models = new pendaftarModel();
        $data = $models->getPendaftar();
        include __DIR__ . '/../Views/others/page_pendaftar.php';
    }

    public function verified()
    {
        $models = new pendaftarModel();
        $data = $models->getVerified();
        include __DIR__ . '/../Views/others/page_verified.php';
    }

    // Misalnya, di Controller Anda
    public function verifySelected()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $ids = $input['ids'] ?? [];


        if (!empty($ids)) {
            error_log("IDs received: " . implode(", ", $ids));
            $response = [];
            foreach ($ids as $id) {
                $model = new pendaftarModel();

                $currentStatus = $model->getVerificationStatus($id);

                $prefix_noUjian = date("m");

                $newStatus = ($currentStatus === "Verified") ? "Unverified" : "Verified";

                if ($newStatus === "Verified") {
                    $no_ujian = $prefix_noUjian . "0" . $id;
                    $pay_status = "Yes";
                } else {
                    $no_ujian = '';
                    $pay_status = "No";
                }

                $data = [
                    'verified' => $newStatus,
                    'no_ujian' => $no_ujian,
                    'pay_status' => $pay_status,
                    'id' => $id
                ];

                $updateSuccess = $model->updateVerificationStatus($id, $newStatus, $no_ujian, $pay_status);

                if (!$updateSuccess) {
                    $response[] = ['success' => false, 'message' => 'Failed to update verification status.'];
                } else {
                    $response[] = ['success' => $updateSuccess, 'updated' => $data];
                }
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $models = new pendaftarModel();
            $detailData = $models->getDetail($id);

            header('Content-Type: application/json');
            echo json_encode($detailData);
        } else {
            echo json_encode(['error' => 'ID parameter is missing.']);
        }
    }



    public function toggleVerified()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        $model = new pendaftarModel();

        $currentStatus = $model->getVerificationStatus($id);

        $prefix_noUjian = date("m");

        $newStatus = ($currentStatus === "Verified") ? "Unverified" : "Verified";

        if ($newStatus === "Verified") {
            $no_ujian = $prefix_noUjian . "0" . $id;
            $pay_status = "Yes";
        } else {
            $no_ujian = '';
            $pay_status = "No";
        }

        $updateSuccess = $model->updateVerificationStatus($id, $newStatus, $no_ujian, $pay_status);

        header('Content-Type: application/json');
        echo json_encode(['success' => $updateSuccess, 'verified' => $newStatus]);
    }

    public function search()
    {
        $search = $_GET['search'];
        $model = new pendaftarModel();


        $data = $model->search($search);

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
