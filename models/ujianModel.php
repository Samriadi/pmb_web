<?php
require_once __DIR__ . '/../config/database.php';


class ujianModel {
    public function getUjian() {
		$db = Database::getInstance();
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM pmb_tagihan a JOIN pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function updateDataFromCSV($csvFilePath) {
        // Baca file CSV
        $file = fopen($csvFilePath, "r");
        $data = [];
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $no_ujian = $column[0];
            $kelulusan = $column[2];
            $data[] = [
                'no_ujian' => $no_ujian,
                'kelulusan' => $kelulusan
            ];
        }
        fclose($file);
    
        // Dapatkan instance koneksi database
        $db = Database::getInstance();
    
        // Bangun string query UPDATE
        $updateValues = [];
        foreach ($data as $row) {
            $updateValues[] = "(" . $db->real_escape_string($row['kelulusan']) . ", " . $db->real_escape_string($row['no_ujian']) . ")";
        }
        $updateQuery = "UPDATE pmb_tagihan SET kelulusan = CASE no_ujian ";
        foreach ($updateValues as $value) {
            $updateQuery .= "WHEN '" . $value['no_ujian'] . "' THEN '" . $value['kelulusan'] . "' ";
        }
        $updateQuery .= "END WHERE no_ujian IN (";
        $updateQuery .= implode(",", array_map(function($value) {
            return "'" . $value['no_ujian'] . "'";
        }, $data));
        $updateQuery .= ")";
    
        // Persiapkan query
        $stmt = $db->prepare($updateQuery);
    
        // Lakukan query UPDATE
        if ($stmt->execute() === TRUE) {
            echo "Records updated successfully";
        } else {
            echo "Error updating records: " . $stmt->error;
        }
    
        // Tutup statement dan koneksi
        $stmt->close();
        $db->close();
    }
    
    
    
}

?>