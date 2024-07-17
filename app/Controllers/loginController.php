<?php

class loginController
{
  public function login()
  {
    include __DIR__ . '/../Views/others/page_login.php';
  }

  public function logout()
  {
    include __DIR__ . '/../Views/others/page_logout.php';
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
      $_SESSION['level_loged'] = $data[0]['userlevel'];
      $_SESSION['user_loged'] = $data[0]['username'];
      echo json_encode(['success' => true, 'data' => $data]);
    } else {
      echo json_encode(['success' => false]);
    }
  }
}
