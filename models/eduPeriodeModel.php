<?php
require_once __DIR__ . '/../config/database.php';


class eduPeriodeModel {
    public function getPeriode() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPeriodeIsInTagihan($recid, $value){
		$db = Database::getInstance();
        $query = "SELECT DISTINCT t2.Periode AS Periode, CASE WHEN t1.periode IS NOT NULL THEN 'true' ELSE 'false' END AS is_in_tagihan FROM edu_periode t2 LEFT JOIN tagihan t1 ON t2.Periode = t1.periode WHERE t2.recid = ? AND t2.Periode = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$recid, $value]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->is_in_tagihan;

    }

    public function addPeriode($jenjang, $periode, $fromDate, $toDate, $keterangan, $status) {
        $db = Database::getInstance();
    
        $query = "INSERT INTO edu_periode (Jenjang, Periode, fromDate, toDate, Keterangan, status) VALUES (?, ?, ?, ?, ?, ?)";
    
        try {
            $stmt = $db->prepare($query);
            $success = $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status]);
    
            if ($success) {
                return ['status' => 'success', 'message' => 'New record added successfully'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to add new record'];
            }
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
    
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
    
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }
    

     public function getPeriodeById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM edu_periode WHERE recid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePeriode($recid, $jenjang, $periode, $fromDate, $toDate, $keterangan, $status) {
        $db = Database::getInstance();

        
        $stmt = $db->prepare("UPDATE edu_periode SET Jenjang = ?, Periode = ?, fromDate = ?, toDate = ?, Keterangan = ?, status = ?  WHERE recid = ?");
        $stmt->execute([$jenjang, $periode, $fromDate, $toDate, $keterangan, $status, $recid]);
    }

     public function deletePeriode($id) {
        $db = Database::getInstance();

        $query = "DELETE FROM edu_periode WHERE recid = ?";

        try {
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getLastPeriode($jenjang) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT ifnull(max(periode), 0) as lastPeriod FROM edu_periode where Jenjang=? and status = 'Open'");
        $stmt->execute([$jenjang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  

    

    
}

?>