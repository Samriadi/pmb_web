<?php
require_once __DIR__ . '/../config/database.php';


class userModel {
    public function getUser() {
		$db = Database::getInstance();
        $query = "SELECT * FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function addUser($username, $user_pass, $user_level) {
		$db = Database::getInstance();

        $query = "INSERT INTO users (username, user_pass, user_level) VALUES (?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$username, $user_pass, $user_level]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE userid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userid, $username, $user_pass, $user_level) {
        $db = Database::getInstance();

        var_dump($userid, $username, $user_pass, $user_level);
        $stmt = $db->prepare("UPDATE users SET username = ?, user_pass = ?, user_level = ? WHERE userid = ?");
        $stmt->execute([$username, $user_pass, $user_level, $userid]);
    }

    public function deleteUser($id) {
        $db = Database::getInstance();

        $query = "DELETE FROM users WHERE userid = ?";

        try {
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
}

?>