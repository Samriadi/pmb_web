<?php
require_once __DIR__ . '/../models/userModel.php';


class userController
{
	public function index()
	{
		$models = new userModel();
		$data = $models->getUser();

		foreach ($data as $dt) :
			$userid = $dt->userid;
			$username = $dt->username;
			$userlevel = $dt->userlevel;
		endforeach;

		include __DIR__ . '/../Views/others/page_user.php';
	}
	public function add()
	{
		$models = new userModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$username = $_POST['username'];
			$userpass = $_POST['userpass'];
			$userlevel = $_POST['userlevel'];

			$models->addUser($username, $userpass, $userlevel);

			echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	public function edit()
	{

		$id = isset($_GET['userid']) ? $_GET['userid'] : null;

		$models = new userModel();

		$data = $models->getUserById($id);

		$response = [
			'userid' => $data->userid,
			'username' => $data->username,
			'userpass' => $data->userpass,
			'userlevel' => $data->userlevel
		];

		echo json_encode($response);
		exit;
	}

	public function update()
	{
		$models = new userModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userid = $_POST['userid'] ?? '';
			$username = $_POST['username'] ?? '';
			$userpass = $_POST['userpass'] ?? '';
			$userlevel = $_POST['userlevel'] ?? '';

			$models->updateUser($userid, $username, $userpass, $userlevel);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	public function delete()
	{

		$id = isset($_GET['userid']) ? $_GET['userid'] : null;

		$models = new userModel();

		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}

		$models->deleteUser($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);

		exit();
	}
}
