<?php
require_once __DIR__ . '/../config/database.php';


class eduPeriodeModel {
    //jadwal test	
    public function getPeriode() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status) {
		$db = Database::getInstance();

        $query = "INSERT INTO edu_periode (Jenjang, Periode, fromDate, toDate, Keterangan, status) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
}

?>