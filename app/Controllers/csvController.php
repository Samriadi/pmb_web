<?php

class csvController
{
  public function index()
  {
    $pendaftar = new pendaftarModel();
    $ujian = new ujianModel();

    $dataPendaftar = $pendaftar->getPendaftar();
    $dataUjian = $ujian->getUjian();

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
