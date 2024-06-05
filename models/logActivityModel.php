<?php
require_once __DIR__ . '/../config/database.php';

class logActivityModel {

    public function logActivity($userid, $datetime, $activity) {
		$db = Database::getInstance();


        $query = "INSERT INTO logs (userid, tanggal, keterangan) VALUES (?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$userid, $datetime, $activity]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
