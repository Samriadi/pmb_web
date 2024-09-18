<?php

class csvController
{
  public function index()
  {
    $models = new pendaftarModel();

    $dataPesertaPMB = $models->getPesertaPMB();
    $dataPesertaUjian = $models->getPesertaUjian();
    $dataPesertaLulus = $models->getPesertaLulus();

    include __DIR__ . '/../Views/others/page_downloadCSV.php';
  }

  public function download()
  {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);
    if (empty($data)) {
      http_response_code(400);
      die('Data tidak valid atau tidak ada.');
    }

    $response = [
      'status' => 'success',
      'message' => 'Data berhasil diterima dan diproses.'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
