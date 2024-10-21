<?php


class mainController
{

    public function dashboard()
    {
        $models = new mainModel();
        $test = $models->getCountTest();
        $var = $models->getCountVar();
        $users = $models->getCountUser();
        $periode = $models->getCountPeriod();
        include __DIR__ . '/../Views/others/page_dashboard.php';
    }

    public function logs()
    {

        $models = new mainModel();
        $data = $models->getLogs();

        include __DIR__ . '/../Views/others/page_activity.php';
    }

    public function help()
    {

        $page = isset($_GET['page']) ? $_GET['page'] : null;

        if ($page == null) {
            include __DIR__ . '/../Views/others/page_helps.php';
        } else {
            try {
                $models = new mainModel();
                $data = $models->getHelp($page);

                if ($data) {
                    $response = [
                        'recid' => $data->recid,
                        'page' => $data->page,
                        'konten' => $data->konten

                    ];
                } else {
                    $response = [
                        'recid' => null,
                        'page' => null,
                        'konten' => null,
                    ];
                }
                echo json_encode($response);
                exit;
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
    public function saveOrUpdateHelp()
    {
        $models = new mainModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $recid = $_POST['recid'];
            $page = $_POST['page'];
            $konten = $_POST['konten'];

            $models->saveOrUpdateHelp($recid, $page, $konten);

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
    public function deleteHelp()
    {

        $id = isset($_GET['recid']) ? $_GET['recid'] : null;

        $models = new mainModel();

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            echo "Invalid ID";
            return;
        }

        $models->deleteHelp($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit();
    }

    public function showHelp()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : null;
        $models = new mainModel();
        $data = $models->showHelp($page);

        include __DIR__ . '/../Views/others/page_panduan.php';
    }

    public function testcard()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : null;

        if ($page === 'web') {
            include __DIR__ . '/../Views/others/page_testCard.php';
        } else if ($page === 'mobile') {
            include __DIR__ . '/../Views/others/page_mobileTestCard.php';
        }
    }

    public function header()
    {
        include __DIR__ . '/../Views/others/page_header.php';
    }

    public function indexRegist()
    {
        include __DIR__ . '/../Views/others/page_regist.php';
    }

    public function addRegist() {
        $nik = $_POST['nik'] ?? ''; 

        $models = new pendaftarModel();
        
        // Mengecek apakah NIK sudah terdaftar
        $checkNik = $models->getDataRegistUsingNik($nik);
        
        if (!empty($checkNik)) {
            $response = [
                'status' => 'exist',
                'message' => 'Anda sudah terdaftar sebelumnya. Silahkan login menggunakan NIK dan password Anda sebelumnya.'
            ];
        }
        else{
            $response =  ['status' => 'null', 'data' => $nik];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insertRegist()
    {
        include __DIR__ . '/../Views/others/page_insertRegist.php';
    }
    
    public function saveRegist(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['name'];
            $choice1 = $_POST['choice1'];
            $choice2 = $_POST['choice2'];
            $choice3 = $_POST['choice3'];
            $registrationType = $_POST['registrationType'];
            $religion = $_POST['religion'];
            $nis = $_POST['nis'];
            $schoolOrigin = $_POST['schoolOrigin'];
            $graduationYear = $_POST['graduationYear'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $region = $_POST['region'];
            $referenceSource = $_POST['referenceSource'];
            $referralId = $_POST['referralId'];
            $password = $_POST['password'];

            if (empty($name) || empty($choice1) || empty($registrationType) || empty($email) || empty($password)) {
                echo json_encode(['status' => 'error', 'message' => 'Data wajib diisi tidak lengkap.']);
                exit;
            }

            try {
                $query = "INSERT INTO pendaftaran_d3 (NamaLengkap, Agama, NIS, AsalKampus, TahunLulus, jenkel, Email, WANumber, alamat, SumberReferensi, UserPass)
                          VALUES (:NamaLengkap, :Agama, :NIS, :AsalKampus, :TahunLulus, :jenkel, :Email, :WANumber, :alamat, :SumberReferensi, :UserPass)";
        
                // Persiapkan statement
                $stmt = $pdo->prepare($query);
        
                // Bind parameter
                $stmt->bindParam(':NamaLengkap', $name);
                $stmt->bindParam(':Agama', $religion);
                $stmt->bindParam(':NIS', $nis);
                $stmt->bindParam(':AsalKampus', $schoolOrigin);
                $stmt->bindParam(':TahunLulus', $graduationYear);
                $stmt->bindParam(':jenkel', $gender);
                $stmt->bindParam(':Email', $email);
                $stmt->bindParam(':WANumber', $phone);
                $stmt->bindParam(':alamat', $region);
                $stmt->bindParam(':SumberReferensi', $referenceSource);
                $stmt->bindParam(':UserPass', $password);
                  
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Pendaftaran berhasil disimpan.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }
}
