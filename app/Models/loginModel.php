<?php

class loginModel
{
  public function authLogin($username, $userpass)
  {
    $db = Database::getInstance();
    $query = "SELECT * FROM usrapp WHERE username = :username AND userpass = :userpass";
    $stmt = $db->prepare($query);
    $stmt->execute([
      ':username' => $username,
      ':userpass' => $userpass,
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
