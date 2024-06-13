<?php


class mainModel
{
    public function getCountTest()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM edu_test;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountVar()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM var_option;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountUser()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM users;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCountPeriod()
    {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) AS jumlah_data FROM edu_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLogs()
    {
        $db = Database::getInstance();
        $query = "SELECT logs.*, users.username as name FROM logs JOIN users ON logs.userid = users.userid;
        ";
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
}
