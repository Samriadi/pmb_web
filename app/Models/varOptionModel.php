<?php


class varOptiontModel
{
    private $varoption;
    private $db;
    public function __construct()
    {
        global $varoption;
        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }
    public function getVar()
    {
        $query = "SELECT * FROM $this->varoption";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addVar($varname, $varvalue, $varothers, $catatan, $parent)
    {
        $query = "INSERT INTO $this->varoption (var_name, var_value, var_others, catatan, parent) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$varname, $varvalue, $varothers, $catatan, $parent]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteVar($recid)
    {
        $query = "DELETE FROM $this->varoption WHERE recid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$recid]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getVarById($recid)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->varoption WHERE recid = ?");
        $stmt->execute([$recid]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function updateVar($recid, $varname, $varvalue, $varothers, $catatan, $parent)
    {
        $stmt = $this->db->prepare("UPDATE $this->varoption SET var_name = ?, var_value = ?, var_others = ?, catatan = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varname, $varvalue, $varothers, $catatan, $parent, $recid]);
    }


    //menangambil var value by var name untuk opsi select
    public function getVarByName($var_name)
    {
        $query = "SELECT * FROM $this->varoption where var_name=:var_name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
                'recid' => $item->recid,
                'var_value' => $item->var_value,
            ];
        }
        return $values;
    }

    public function getProdiByJenjang($var_name, $var_others)
    {
        $query = "SELECT * FROM $this->varoption where var_name=:var_name AND var_others = :var_others";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':var_name', $var_name);
        $stmt->bindParam(':var_others', $var_others);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $values = [];
        foreach ($data as $item) {
            $values[] = [
                'recid' => $item->recid,
                'var_value' => $item->var_value,
                'var_others' => $item->var_others

            ];
        }
        return $values;
    }
    //

    //menyimpan opsi inputan tambahan
    public function addOptional($var_name, $var_value)
    {

        var_dump($var_name);
        var_dump($var_value);
        try {

            $query = "INSERT INTO $this->varoption (var_name, var_value) VALUES (:var_name, :var_value)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':var_name', $var_name);
            $stmt->bindParam(':var_value', $var_value);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Koneksi atau query bermasalah: " . $e->getMessage()]);
        }
    }
    //




}
