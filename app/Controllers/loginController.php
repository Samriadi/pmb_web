<?php

class loginController
{
  public function login()
  {
    include __DIR__ . '/../Views/others/page_login.php';
  }

  public function authLogin()
  {

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    $username = $input['username'];
    $userpass = $input['userpass'];

    $models = new loginModel();

    $data = $models->authLogin($username, $userpass);


    if ($data) {
      $_SESSION['userlevel'] = $data[0]['userlevel'];


      echo json_encode(['success' => true, 'data' => $data]);
    } else {
      echo json_encode(['success' => false]);
    }
  }
}
