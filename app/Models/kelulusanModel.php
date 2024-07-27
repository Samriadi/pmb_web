<?php
require_once __DIR__ . '/../Core/Database.php';

class kelulusanModel
{
  private $pmb_tagihan;
  private $pmb_mahasiswa;
  private $pmb_pembayaran;
  private $pmb_kelulusan;
  private $pmb_periode;
  private $varoption;
  private $db;
  public function __construct()
  {
    global $pmb_tagihan;
    global $pmb_mahasiswa;
    global $pmb_pembayaran;
    global $pmb_kelulusan;
    global $pmb_periode;
    global $varoption;
    $this->pmb_tagihan = $pmb_tagihan;
    $this->pmb_mahasiswa = $pmb_mahasiswa;
    $this->pmb_pembayaran = $pmb_pembayaran;
    $this->pmb_kelulusan = $pmb_kelulusan;
    $this->pmb_periode = $pmb_periode;
    $this->varoption = $varoption;
    $this->db = Database::getInstance();
  }
  public function getKeteranganTes()
  {
    $query = "SELECT a.id, a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM $this->pmb_tagihan a JOIN $this->pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function showKelulusan()
  {
    $query = "SELECT a.id, a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap, c.prodi_lulus FROM $this->pmb_tagihan a JOIN $this->pmb_mahasiswa b ON a.member_id = b.ID JOIN $this->pmb_kelulusan c ON a.id = c.id_tagihan WHERE a.kelulusan ='Yes'";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function getProdiByNoUjian($id)
  {
    $query = "SELECT 
              COALESCE(d1.var_value, '') AS Prodi1,
              COALESCE(d2.var_value, '') AS Prodi2,
              COALESCE(d3.var_value, '') AS Prodi3 
              FROM $this->pmb_tagihan a
              LEFT JOIN 
              $this->varoption d1 ON d1.recid = a.PilihanPertama
              LEFT JOIN 
              $this->varoption d2 ON d2.recid = a.PilihanKedua
              LEFT JOIN 
              $this->varoption d3 ON d3.recid = a.PilihanKetiga
              WHERE a.id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      return [
        "success" => true,
        "PilihanPertama" => $row['Prodi1'],
        "PilihanKedua" => $row['Prodi2'],
        "PilihanKetiga" => $row['Prodi3'],
      ];
    } else {
      return [
        "error" => "No data found for the provided examination number."
      ];
    }
  }

  public function addKelulusan($idTagihan, $prodiLulus)
  {
    $query = "INSERT INTO $this->pmb_kelulusan (id_tagihan, prodi_lulus) VALUES (?, ?)";
    $stmt = $this->db->prepare($query);
    $result = $stmt->execute([$idTagihan, $prodiLulus]);

    if ($result) {
      $stmt = $this->db->prepare("UPDATE $this->pmb_tagihan SET kelulusan = ? WHERE id = ?");
      $result = $stmt->execute(["Yes", $idTagihan]);
      if ($result) {
        $stmt = $this->db->prepare("SELECT a.*, COALESCE(c1.var_value, '') AS 'Pilihan Pertama', COALESCE(c2.var_value, '') AS 'Pilihan Kedua', COALESCE(c3.var_value, '') AS 'Pilihan Ketiga', b.Periode as periode_tagihan FROM $this->pmb_tagihan a JOIN $this->pmb_periode b ON b.recid = a.periode JOIN $this->varoption c1 ON c1.recid = a.PilihanPertama JOIN varoption c2 ON c2.recid = a.PilihanKedua JOIN varoption c3 ON c3.recid = a.PilihanKetiga WHERE a.id = ?");
        $stmt->execute([$idTagihan]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {

          if ($prodiLulus == "Profesi Apoteker") {
            $kodeProdi = '01';
          } elseif ($prodiLulus == "Farmasi") {
            if ($data['jenjang'] == 'S1') {
              $kodeProdi = '02';
            } elseif ($data['jenjang'] == 'D3') {
              $kodeProdi = '03';
            }
          } elseif ($prodiLulus == "Kebidanan") {
            $kodeProdi = '04';
          } elseif ($prodiLulus == "Akuntansi") {
            $kodeProdi = '05';
          } elseif ($prodiLulus == "Hukum") {
            $kodeProdi = '06';
          } elseif ($prodiLulus == "Ilmu Komunikasi") {
            $kodeProdi = '07';
          } elseif ($prodiLulus == "Manajemen") {
            $kodeProdi = '08';
          } elseif ($prodiLulus == "Informatika") {
            $kodeProdi = '09';
          } elseif ($prodiLulus == "Sistem Informasi") {
            $kodeProdi = '10';
          }


          $stmt = $this->db->prepare("INSERT INTO $this->pmb_pembayaran (member_id, no_ujian, va_number, trans_date, tagihan, pay_status, verified, invoice_id, catatan, bukti_transfer, prodi, proses, bukti_regis, berkas_regis, promo, periode, jenis, kategori, jenjang, prodi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $result = $stmt->execute([
            $data['member_id'],
            $data['no_ujian'] ?? NULL,
            $data['nomor_va'] ?? NULL,
            $data['trans_date'] ?? NULL,
            $data['jumlah_tagihan'] ?? NULL,
            $data['pay_status'] ?? NULL,
            $data['verified'] ?? NULL,
            $data['invoice_id'] ?? NULL,
            $data['catatan'] ?? NULL,
            $data['bukti_transfer'] ?? NULL,
            $prodiLulus,
            $data['proses'] ?? NULL,
            $data['bukti_regis'] ?? NULL,
            $data['berkas_regis'] ?? NULL,
            $data['promo'] ?? NULL,
            $data['periode_tagihan'] ?? NULL,
            $data['jenis'] ?? NULL,
            $data['kategori'] ?? NULL,
            $data['jenjang'] ?? NULL,
            $kodeProdi
          ]);
          if ($result) {
            return [
              "success" => true,
              "data" => $data['member_id']
            ];
          }
        }
      }
    } else {
      return [
        "success" => false
      ];
    }
  }
}
