<?php

class loginModel
{
  private $usrapp;
  private $db;
  public function __construct()
    {
        global $usrapp;
        $this->usrapp = $usrapp;
        $this->db = Database::getInstance();
    }

  public function authLogin($username, $userpass)
  {
    $query = "SELECT * FROM $this->usrapp WHERE username = :username AND userpass = :userpass";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':username' => $username,
      ':userpass' => $userpass,
    ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
