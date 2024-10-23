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
        $models = new varOptiontModel();

        $dataProdi = $models->getVarByName('Prodi');

        error_log("dataProdi: " . print_r($dataProdi, true));

        include __DIR__ . '/../Views/others/page_insertRegist.php';
    }
    
    public function saveRegist(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = json_decode(file_get_contents('php://input'), true);  // Decode JSON
        
            $nik = $data['nik'];
            $name = $data['name'];
            $choice1 = $data['choice1'];
            $choice2 = $data['choice2'];
            $choice3 = $data['choice3'];
            $registrationType = $data['registrationType'];
            $religion = $data['religion'];
            $nis = $data['nis'];
            $schoolOrigin = $data['schoolOrigin'];
            $graduationYear = $data['graduationYear'];
            $gender = $data['gender'];
            $email = $data['email'];
            $phone = $data['phone'];
            $region = $data['region'];
            $referenceSource = $data['referenceSource'];
            $referralId = $data['referralId'];
            $password = $data['password'];
			$userpass = $this->getPassword($password);




            if (empty($name) || empty($choice1) || empty($registrationType) || empty($email) || empty($userpass)) {
                echo json_encode(['status' => 'error', 'message' => 'Data wajib diisi tidak lengkap.']);
                exit;
            }

            try {
                $models = new pendaftarModel();
        
                $savePendaftaran = $models->saveDataRegist($nik, $name,$religion,$nis,$schoolOrigin,$graduationYear,$gender,$email,$phone,$region,$referenceSource,$userpass);

                  
                header('Content-Type: application/json');
                
                if ($savePendaftaran) {
                    $member_id = $models->getIdRegistUsingNik($nik);

                    $models->saveDataProdiRegist($member_id)

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

    private function getPassword($data)
	{
		$x = base64_encode($data);

		return crypt($x, $this->encKey());
	}

	private function encKey()
	{
		return '$2y$10$' . bin2hex(random_bytes(11));
	}
}
