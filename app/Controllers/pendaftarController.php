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

    public function tagihan()
    {
        $models = new pendaftarModel();
        $data = $models->getTagihan();
        include __DIR__ . '/../Views/others/page_tagihan.php';
    }

    public function verifySelected()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $ids = $input['ids'] ?? [];
        $response = [];

        if (!empty($ids)) {
            error_log("IDs received: " . implode(", ", $ids));
            $model = new pendaftarModel();

            foreach ($ids as $id) {
                $currentStatus = $model->getMultipleVerificationStatus($id);
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

                $updateSuccess = $model->updateMultipleVerificationStatuses($data);

                if (!$updateSuccess) {
                    $response[] = ['success' => false, 'id' => $id, 'message' => 'Failed to update verification status.'];
                } else {
                    $response[] = ['success' => true, 'id' => $id, 'updated' => $data];
                }
            }
        } else {
            $response[] = ['success' => false, 'message' => 'No IDs provided.'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
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

    // public function search()
    // {
    //     $search = $_GET['search'];
    //     $model = new pendaftarModel();


    //     $data = $model->search($search);

    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    // }
}
