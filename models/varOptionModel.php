<?php
require_once __DIR__ . '/../config/database.php';


class varOptiontModel {
     public function getVar() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

     public function addVar($recid, $varname, $varvalue, $varothers, $catatan, $parent) {
		$db = Database::getInstance();

        $query = "INSERT INTO var_option (recid, var_name, var_value, var_others, catatan, parent) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$recid, $varname, $varvalue, $varothers, $catatan, $parent]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteVar($recid) {
        $db = Database::getInstance();

        $query = "DELETE FROM var_option WHERE recid = ?";

        try {
        $stmt = $db->prepare($query);
        $stmt->execute([$recid]);
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

    public function updateVar($recid, $varname, $varvalue, $varothers, $catatan, $parent) {
        $db = Database::getInstance();

        $stmt = $db->prepare("UPDATE var_option SET var_name = ?, var_value = ?, var_others = ?, catatan = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varname, $varvalue, $varothers, $catatan, $parent, $recid]);
    }
    
}

?>