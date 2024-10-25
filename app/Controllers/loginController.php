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

      $_SESSION['level_loged'] = $data['userlevel'];
      $_SESSION['user_loged'] = $data['username'];
      $_SESSION['user_type'] = $data['user_type'];
      $_SESSION['user_modul'] = $data['modul'];
      echo json_encode(['success' => true, 'data' => $data]);
    } else {
      echo json_encode(['success' => false]);
    }
  }

  public function googleLoginCallback()
  {
    include __DIR__ . '/../Views/others/page_googleCallback.php';
  }

  public function authGoogleLogin()
  {

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    $email = $input['email'];

    $models = new loginModel();

    $data = $models->authGoogleLogin($email);


    if ($data) {
      $_SESSION['level_loged'] = $data[0]['userlevel'];
      $_SESSION['user_loged'] = $data[0]['username'];
      echo json_encode(['success' => true, 'data' => $data]);
    } else {
      echo json_encode(['success' => false]);
    }
  }
}
