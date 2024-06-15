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
			$user_level = $dt->user_level;
		endforeach;

		include __DIR__ . '/../Views/others/page_user.php';
	}
	public function add()
	{
		$models = new userModel();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$username = $_POST['username'];
			$user_pass = $_POST['user_pass'];
			$user_level = $_POST['user_level'];

			$models->addUser($username, $user_pass, $user_level);

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
			'user_pass' => $data->user_pass,
			'user_level' => $data->user_level
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
			$user_pass = $_POST['user_pass'] ?? '';
			$user_level = $_POST['user_level'] ?? '';

			$models->updateUser($userid, $username, $user_pass, $user_level);
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
