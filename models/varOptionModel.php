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


    //menangambil var value by var name untuk opsi select
    public function getVarByName($var_name) {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name=:var_name";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
				'recid' => $item->recid,
                'var_value' => $item->var_value
            ];
        }
        return $values;
    }
    //

    //menyimpan opsi inputan tambahan
    public function addOptional($var_name, $var_value) {
		try {
            $db = Database::getInstance();

            $query = "INSERT INTO var_option (var_name, var_values) VALUES (:var_name, :namaSingkat, :var_values)";
                
            $stmt = $db->prepare($query);
            $stmt->bindParam(':var_name', $var_name);
            $stmt->bindParam(':var_values', $var_value);


            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
            } 
            else {
                echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Koneksi atau query bermasalah: " . $e->getMessage()]);
        }
    }
    //



    
}

?>