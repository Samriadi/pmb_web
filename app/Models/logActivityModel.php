<?php

class logActivityModel {

    private $pmb_logs;
    private $db;

    public function __construct() {
        global $pmb_logs;

        $this->pmb_logs = $pmb_logs;
        $this->db->Database::getInstance();    }

    public function logActivity($usr_name, $datetime, $activity) {
        $query = "INSERT INTO $this->pmb_logs (usr_name, tanggal, keterangan) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$usr_name, $datetime, $activity]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
