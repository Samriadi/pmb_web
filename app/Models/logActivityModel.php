<?php

class logActivityModel {

    public function logActivity($usr_name, $datetime, $activity) {
		$db = Database::getInstance();


        $query = "INSERT INTO pmb_logs (usr_name, tanggal, keterangan) VALUES (?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$usr_name, $datetime, $activity]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
