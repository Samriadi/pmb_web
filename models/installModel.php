<?php
require_once __DIR__ . '/../config/database.php';


class installModel {
  
    public function save($namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $tingkatan, $kodeWarnaUtama, $optionalFieldsJson) {
		
        $db = Database::getInstance();

        $query = "INSERT INTO var_install (nama_lengkap_kampus, nama_singkat, jalan, kota, provinsi, negara, tingkatan, kode_warna_utama, optional_fields) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssssssss", $namaLengkapKampus, $namaSingkat, $jalan, $kota, $provinsi, $negara, $tingkatan, $kodeWarnaUtama, $optionalFieldsJson);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan";
        } else {
            echo "Error: " . $stmt->error;
        }   
        
        $stmt->close();
        $db->close();

    }

}

?>