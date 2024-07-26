<?php
class userModel
{
    private $usrapp;
    private $db;
    public function __construct()
    {
        global $usrapp;
        $this->usrapp = $usrapp;
        $this->db = Database::getInstance();
    }

    public function getUser()
    {
        $query = "SELECT * FROM $this->usrapp";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function addUser($username, $userpass, $userlevel)
    {

        $query = "INSERT INTO $this->usrapp (username, userpass, userlevel) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $userpass, $userlevel]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->usrapp WHERE userid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateUser($userid, $username, $userpass, $userlevel)
    {
        $stmt = $this->db->prepare("UPDATE $this->usrapp SET username = ?, userpass = ?, userlevel = ? WHERE userid = ?");
        $stmt->execute([$username, $userpass, $userlevel, $userid]);
    }

    public function deleteUser($id)
    {

        $query = "DELETE FROM $this->usrapp WHERE userid = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function reset_password($user_id, $hashed_password)
    {
        $stmt = $this->db->prepare("UPDATE $this->usrapp SET userpass = ? WHERE userid = ?");
        $req = $stmt->execute([$hashed_password, $user_id]);
        if ($req) {
            return true;
        } else {
            return false;
        }
    }
}
