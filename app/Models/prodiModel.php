<?php


class prodiModel
{

    private $varoption;
    private $db;
    public function __construct()
    {
        global $varoption;
        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }

    public function getProdi()
    {
        $query = "SELECT 
                        $this->varoption.*, 
                        Fakultas.var_value AS NamaFakultas,
                        Jenjang.var_others AS Biaya,
                        Jenjang.catatan AS Catatan
                    FROM 
                        $this->varoption 
                    LEFT JOIN 
                        (SELECT * FROM $this->varoption WHERE var_name='Fakultas') AS Fakultas 
                        ON $this->varoption.parent = Fakultas.recid
                    LEFT JOIN 
                        (SELECT * FROM $this->varoption WHERE var_name='Jenjang') AS Jenjang 
                        ON $this->varoption.var_others = Jenjang.var_value
                    WHERE 
                        $this->varoption.var_name='Prodi';";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function add($varname, $varvalue, $varothers, $parent)
    {
        $query = "INSERT INTO $this->varoption (var_name, var_value, var_others, parent) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$varname, $varvalue, $varothers, $parent]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getVarById($recid)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->varoption WHERE recid = ?");
        $stmt->execute([$recid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getVarByName($var_name)
    {
        $query = "SELECT * FROM $this->varoption where var_name=:var_name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateVar($recid, $varvalue, $varothers, $parent)
    {
        $stmt = $this->db->prepare("UPDATE $this->varoption SET var_value = ?, var_others = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varvalue, $varothers, $parent, $recid]);
    }
}
