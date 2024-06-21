<?php


class userModel
{
    public function getUser()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM usrapp";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function addUser($username, $userpass, $userlevel)
    {
        $db = Database::getInstance();

        $query = "INSERT INTO usrapp (username, userpass, userlevel) VALUES (?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$username, $userpass, $userlevel]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usrapp WHERE userid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateUser($userid, $username, $userpass, $userlevel)
    {
        $db = Database::getInstance();

        var_dump($userid, $username, $userpass, $userlevel);
        $stmt = $db->prepare("UPDATE usrapp SET username = ?, userpass = ?, userlevel = ? WHERE userid = ?");
        $stmt->execute([$username, $userpass, $userlevel, $userid]);
    }

    public function deleteUser($id)
    {
        $db = Database::getInstance();

        $query = "DELETE FROM usrapp WHERE userid = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
