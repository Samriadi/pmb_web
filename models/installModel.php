<?php
require_once __DIR__ . '/../config/database.php';


class installModel {
  
    public function save($namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $tingkatan, $kodeWarnaUtama, $optionalFieldsJson) {
        try {
            $db = Database::getInstance();

            $query = "INSERT INTO var_install (nama_lengkap_kampus, nama_singkat, jalan, kota, provinsi, negara, tingkatan, kode_warna_utama, optional_fields) VALUES (:namaLengkapKampus, :namaSingkat, :jalan, :kota, :provinsi, :negara, :tingkatan, :kodeWarnaUtama, :optionalFieldsJson)";
                
            $stmt = $db->prepare($query);
            $stmt->bindParam(':namaLengkapKampus', $namaLengkapKampus);
            $stmt->bindParam(':namaSingkat', $namaSingkat);
            $stmt->bindParam(':jalan', $jalan);
            $stmt->bindParam(':kota', $kota);
            $stmt->bindParam(':provinsi', $provinsi);
            $stmt->bindParam(':negara', $negara);
            $stmt->bindParam(':tingkatan', $tingkatan);
            $stmt->bindParam(':kodeWarnaUtama', $kodeWarnaUtama);
            $stmt->bindParam(':optionalFieldsJson', $optionalFieldsJson);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
            } 
            else {
                echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Koneksi atau query bermasalah: " . $e->getMessage()]);
        }
    }
}
?>