<?php
class installModel
{
    private $varinstall;
    private $db;

    public function __construct(){
        global $varinstall;
        $this->varinstall = $varinstall;
        $this->db = Database::getInstance();
    }
    public function getInstall()
    {
        $query = "SELECT * FROM $this->varinstall";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function save($namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $kodeWarnaUtama)
    {
        try {
            $query = "INSERT INTO $this->varinstall (nama_lengkap_kampus, nama_singkat, jalan, kota, provinsi, negara, kode_warna_utama) VALUES (:namaLengkapKampus, :namaSingkat, :jalan, :kota, :provinsi, :negara, :kodeWarnaUtama)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':namaLengkapKampus', $namaLengkapKampus);
            $stmt->bindParam(':namaSingkat', $namaSingkat);
            $stmt->bindParam(':jalan', $jalan);
            $stmt->bindParam(':kota', $kota);
            $stmt->bindParam(':provinsi', $provinsi);
            $stmt->bindParam(':negara', $negara);
            $stmt->bindParam(':kodeWarnaUtama', $kodeWarnaUtama);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Koneksi atau query bermasalah: " . $e->getMessage()]);
        }
    }
}
