<?php

class loginModel
{
  private $usrapp;
  private $mhs_mahasiswa;
  private $mhs_dosen;
  private $mhs_staff;
  private $db;

  public function __construct()
  {
    global $usrapp;
    global $mhs_mahasiswa;
    global $mhs_dosen;
    global $mhs_staff;

    $this->usrapp = $usrapp;
    $this->mhs_mahasiswa = $mhs_mahasiswa;
    $this->mhs_dosen = $mhs_dosen;
    $this->mhs_staff = $mhs_staff;

    $this->db = Database::getInstance();
  }

  public function authLogin($username, $userpass)
  {
      $query = "SELECT 'accounts' AS user_type, 
                        username, 
                        userpass, 
                        CASE 
                            WHEN userlevel = 'admin' THEN 'mhs' 
                            WHEN userlevel = 'supervisor' THEN 'mhs' 
                            ELSE 'pmb-mhs' 
                        END AS modul, 
                        userlevel
                  FROM $this->usrapp
                  WHERE username = :username

                  UNION

                  SELECT 'mahasiswa' AS user_type, UserName, UserPass, 'mhs' AS modul, NULL AS userlevel
                  FROM $this->mhs_mahasiswa
                  WHERE username = :username

                  UNION

                  SELECT 'staff' AS user_type, username, userpass, 'pmb' AS modul, 'staf' AS userlevel
                  FROM $this->mhs_staff
                  WHERE username = :username";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':username' => $username,
    ]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
      $encodedPassword = base64_encode($userpass);
      $inputHash = crypt($encodedPassword, $data['userpass']);

      if ($inputHash === $data['userpass']) {
        return [
          'username' => $data['username'],
          'userlevel' => $data['userlevel'],
          'user_type' => $data['user_type'],
          'modul' => $data['modul']
        ];
      }
    }
    return null;
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
