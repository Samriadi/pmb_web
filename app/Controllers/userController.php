<?php


class userController
{

	private $models;

	public function __construct()
	{
		$this->models = new userModel();
	}
	public function index()
	{
		$data = $this->models->getUser();

		foreach ($data as $dt) :
			$userid = $dt->userid;
			$username = $dt->username;
			$userlevel = $dt->userlevel;
		endforeach;

		include __DIR__ . '/../Views/others/page_user.php';
	}
	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$username = $_POST['username'];
			$userpass = $_POST['userpass'];
			$userlevel = $_POST['userlevel'];

			$userpass = $this->getPassword($userpass);

			$this->models->addUser($username, $userpass, $userlevel);

			echo json_encode(['status' => 'success', 'message' => 'New Record Added']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	private function getPassword($data)
	{
		$x = base64_encode($data);

		return crypt($x, $this->encKey());
	}

	private function encKey()
	{
		return '$2y$10$' . bin2hex(random_bytes(11));
	}


	public function edit()
	{

		$id = isset($_GET['userid']) ? $_GET['userid'] : null;


		$data = $this->models->getUserById($id);

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
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userid = $_POST['userid'] ?? '';
			$username = $_POST['username'] ?? '';
			$userpass = $_POST['userpass'] ?? '';
			$userlevel = $_POST['userlevel'] ?? '';

			$this->models->updateUser($userid, $username, $userpass, $userlevel);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
		}
	}

	public function delete()
	{

		$id = isset($_GET['userid']) ? $_GET['userid'] : null;


		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false) {
			echo "Invalid ID";
			return;
		}

		$this->models->deleteUser($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);

		exit();
	}

	public function reset()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password']) && isset($_POST['userid'])) {
			$userid = intval($_POST['userid']);
			$username = $_POST['username'];
			$fullname = $_POST['fullname'];

			$first_letter = substr($fullname, 0, 1);
			$last_three_letters = substr($fullname, -3);
			$last_two_digits = substr(strval($userid), -2);

			$default_password = $first_letter . $last_three_letters . $last_two_digits;

			$hashed_password = $this->getPassword($default_password);
			$req = $this->models->reset_password($userid, $hashed_password);

			if ($req == true) {
				echo json_encode([
					'status' => 'success',
					'message' => 'Fullname : ' . $fullname . "<br>" . 'Username : ' . $username . "<br>" . 'New Userpass : ' . $default_password
				]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to reset password.']);
			}
		}
	}
}
