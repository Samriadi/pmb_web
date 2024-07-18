<?php


class mainModel
{
    private $usrapp;
    private $pmb_test;
    private $varoption;
    private $pmb_periode;
    private $pmb_logs;
    private $pmb_helps;
    private $db;
    public function __construct()
    {
        global $usrapp;
        global $varoption;
        global $pmb_test;
        global $pmb_periode;
        global $pmb_logs;
        global $pmb_helps;

        $this->usrapp = $usrapp;
        $this->pmb_test = $pmb_test;
        $this->pmb_periode = $pmb_periode;
        $this->varoption = $varoption;
        $this->pmb_logs = $pmb_logs;
        $this->pmb_helps = $pmb_helps;
        $this->db = Database::getInstance();
    }
    public function getCountTest()
    {
        $query = "SELECT COUNT(*) AS jumlah_data FROM $this->pmb_test;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountVar()
    {
        $query = "SELECT COUNT(*) AS jumlah_data FROM $this->varoption;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountUser()
    {
        $query = "SELECT COUNT(*) AS jumlah_data FROM $this->usrapp;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountPeriod()
    {
        $query = "SELECT COUNT(*) AS jumlah_data FROM $this->pmb_periode";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLogs()
    {
        $query = "SELECT * FROM $this->pmb_logs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getHelp($page)
    {
        $query = "SELECT * FROM $this->pmb_helps WHERE page = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$page]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function saveOrUpdateHelp($recid, $page, $konten)
    {
        $checkQuery = "SELECT COUNT(*) FROM $this->pmb_helps WHERE recid = ?";
        $checkStmt = $this->db->prepare($checkQuery);
        $checkStmt->execute([$recid]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            $updateQuery = "UPDATE $this->pmb_helps SET konten = ?, page = ? WHERE recid = ?";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->execute([$konten, $page, $recid]);
        } else {
            $insertQuery = "INSERT INTO pmb_helps (page, konten) VALUES (?, ?)";
            $insertStmt = $this->db->prepare($insertQuery);
            $insertStmt->execute([$page, $konten]);
        }
    }
    public function deleteHelp($recid)
    {

        $query = "DELETE FROM $this->pmb_helps WHERE recid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$recid]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function showHelp($page)
    {
        $query = "SELECT konten FROM $this->pmb_helps WHERE page = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$page]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
