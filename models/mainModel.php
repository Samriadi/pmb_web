<?php
require_once __DIR__ . '/../config/database.php';


class mainModel {
      public function getCountTest() {
		$db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM edu_test;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

     public function getCountVar() {
		$db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM var_option;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

?>