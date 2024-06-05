<?php
require_once __DIR__ . '/../config/database.php';


class prodiModel {
    public function getProdi() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option WHERE var_name='Prodi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}