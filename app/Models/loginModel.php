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
    $query = "SELECT username, userlevel, userpass FROM $this->usrapp WHERE username = :username";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':username' => $username,
    ]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
      $encodedPassword = base64_encode($userpass);
      $inputHash = crypt($encodedPassword, $data['userpass']);

      if ($inputHash === $data['userpass']) {
        return $data = [
          'username' => $data['username'],
          'userlevel' => $data['userlevel'],
        ];
      }
    }
  }


  public function authGoogleLogin($email)
  {
    $query = "SELECT * FROM $this->usrapp WHERE useremail = :email";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':email' => $email,
    ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
