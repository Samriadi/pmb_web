<?php


class mainModel
{
    public function getCountTest()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM pmb_test;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountVar()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM varoption;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountUser()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM usrapp;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountPeriod()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM pmb_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLogs()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM pmb_logs";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getHelp($page)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM pmb_helps WHERE page = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$page]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function saveOrUpdateHelp($recid, $page, $konten)
    {
        $db = Database::getInstance();

        $checkQuery = "SELECT COUNT(*) FROM pmb_helps WHERE recid = ?";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->execute([$recid]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            $updateQuery = "UPDATE pmb_helps SET konten = ?, page = ? WHERE recid = ?";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->execute([$konten, $page, $recid]);
        } else {
            $insertQuery = "INSERT INTO pmb_helps (page, konten) VALUES (?, ?)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->execute([$page, $konten]);
        }
    }
    public function deleteHelp($recid)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM pmb_helps WHERE recid = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$recid]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function showHelp($page)
    {
        $db = Database::getInstance();
        $query = "SELECT konten FROM pmb_helps WHERE page = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$page]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
