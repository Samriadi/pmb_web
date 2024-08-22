<?php


class kelulusanController
{

  private $kelulusanModel;

  public function __construct()
  {
    $this->kelulusanModel = new kelulusanModel();
  }
  public function kelulusan()
  {
    $data = $this->kelulusanModel->getKeteranganTes();
    include __DIR__ . '/../Views/others/page_konfirmasiKelulusan.php';
  }
  public function showKelulusan()
  {
    $data = $this->kelulusanModel->showKelulusan();
    include __DIR__ . '/../Views/others/page_informasiKelulusan.php';
  }
  public function getProdi()
  {
    if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $data = $this->kelulusanModel->getProdiByNoUjian($id);

      header('Content-Type: application/json');
      echo json_encode($data);
    } else {
      echo json_encode(['error' => 'No examination number provided.']);
    }
  }

  public function addKelulusan()
  {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (isset($input['data']) && is_array($input['data'])) {
      $data = $input['data'];

      foreach ($data as $dt) {
        $idTagihan = $dt['idTagihan'];
        $prodiLulus = $dt['prodiLulus'];
      }
    }
    $response = $this->kelulusanModel->addKelulusan($idTagihan, $prodiLulus);
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
