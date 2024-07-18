<?php


class fakultasModel
{
    private $varoption;
    private $db;
    public function __construct()
    {
        global $varoption;

        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }
    public function getFakultas()
    {
        try {
            $query = "SELECT $this->varoption.*, Kampus.var_value AS NamaKampus FROM $this->varoption LEFT JOIN (SELECT * FROM $this->varoption WHERE var_name='Kampus') AS Kampus 
            ON $this->varoption.parent = Kampus.recid WHERE $this->varoption.var_name='Fakultas'";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            // Handle database error
            return [];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            // Handle other unexpected errors
            return [];
        }
    }

    public function add($varname, $varvalue, $varothers, $parent)
    {

        $query = "INSERT INTO $this->varoption (var_name, var_value, var_others, parent) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$varname, $varvalue, $varothers, $parent]);
            return ['status' => 'success', 'message' => 'New record added successfully'];
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }


    public function getVarById($recid)
    {

        $query = "SELECT * FROM $this->varoption WHERE recid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$recid]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }

    public function getVarByName($var_name)
    {

        $query = "SELECT * FROM $this->varoption WHERE var_name=:var_name";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':var_name', $var_name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }


    public function updateVar($recid, $varvalue, $varothers, $parent)
    {

        $query = "UPDATE $this->varoption SET var_value = ?, var_others = ?, parent = ? WHERE recid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$varvalue, $varothers, $parent, $recid]);
            return ['status' => 'success', 'message' => 'Record updated successfully'];
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'Database error: ' . $errorMessage];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return ['status' => 'error', 'message' => 'An unexpected error occurred: ' . $errorMessage];
        }
    }
}
