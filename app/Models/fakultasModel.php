<?php


class fakultasModel
{
    public function getFakultas()
    {
        try {
            $db = Database::getInstance();
            $query = "SELECT varoption.*, Kampus.var_value AS NamaKampus FROM varoption LEFT JOIN (SELECT * FROM varoption WHERE var_name='Kampus') AS Kampus 
            ON varoption.parent = Kampus.recid WHERE varoption.var_name='Fakultas'";
            $stmt = $db->prepare($query);
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
        $db = Database::getInstance();

        $query = "INSERT INTO varoption (var_name, var_value, var_others, parent) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
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
        $db = Database::getInstance();

        $query = "SELECT * FROM varoption WHERE recid = ?";

        try {
            $stmt = $db->prepare($query);
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
        $db = Database::getInstance();

        $query = "SELECT * FROM varoption WHERE var_name=:var_name";

        try {
            $stmt = $db->prepare($query);
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
        $db = Database::getInstance();

        $query = "UPDATE varoption SET var_value = ?, var_others = ?, parent = ? WHERE recid = ?";

        try {
            $stmt = $db->prepare($query);
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
