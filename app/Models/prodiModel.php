<?php


class prodiModel
{
    public function getProdi()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        varoption.*, 
                        Fakultas.var_value AS NamaFakultas,
                        Jenjang.var_others AS Biaya,
                        Jenjang.catatan AS Catatan
                    FROM 
                        varoption 
                    LEFT JOIN 
                        (SELECT * FROM varoption WHERE var_name='Fakultas') AS Fakultas 
                        ON varoption.parent = Fakultas.recid
                    LEFT JOIN 
                        (SELECT * FROM varoption WHERE var_name='Jenjang') AS Jenjang 
                        ON varoption.var_others = Jenjang.var_value
                    WHERE 
                        varoption.var_name='Prodi';";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function add($varname, $varvalue, $varothers, $parent)
    {
        $db = Database::getInstance();

        $query = "INSERT INTO varoption (var_name, var_value, var_others, parent) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$varname, $varvalue, $varothers, $parent]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getVarById($recid)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM varoption WHERE recid = ?");
        $stmt->execute([$recid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getVarByName($var_name)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM varoption where var_name=:var_name";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateVar($recid, $varvalue, $varothers, $parent)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("UPDATE varoption SET var_value = ?, var_others = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varvalue, $varothers, $parent, $recid]);
    }
}
