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

    public function getVarById($recid) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM var_option WHERE recid = ?");
        $stmt->execute([$recid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getVarByName($var_name) {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name=:var_name";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function updateVar($recid, $varvalue, $varothers, $parent) {
        $db = Database::getInstance();

        $stmt = $db->prepare("UPDATE var_option SET var_value = ?, var_others = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varvalue, $varothers, $parent, $recid]);
    }


    
}

?>