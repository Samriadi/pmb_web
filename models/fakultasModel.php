<?php
require_once __DIR__ . '/../config/database.php';


class fakultasModel {
     public function getFakultas() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option WHERE var_name='Fakultas'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function add($varname, $varvalue, $varothers, $parent) {
		$db = Database::getInstance();

        $query = "INSERT INTO var_option (var_name, var_value, var_others, parent) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$varname, $varvalue, $varothers, $parent]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
}

?>