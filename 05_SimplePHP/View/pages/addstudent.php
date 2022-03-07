<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->signUp($userModel);

		require_once('../05_SimplePHP/View/layouts/client/signup.php');
	}

	public function signUp($userModel) {
        $username = $password = $hoten = $email = $phonenumber = $avatar = $role = NULL;
        $role = "student";
		$error = array();
		$error['username'] = $error['password'] = $error['hoten'] = $error['username_exist'] = $error['hoten'] = NULL;

		if (isset($_POST['signup'])) {
			if (empty($_POST['username'])) {
				$error['username'] = '* Cần điền tên đăng nhập';
			} else {
				$username = $_POST['username'];
			}
			if (empty($_POST['password'])) {
				$error['password'] = '* Cần điền mật khẩu';
			} else {
				$password = md5($_POST['password']);
			}
			if (empty($_POST['hoten'])) {
				$error['hoten'] = '* Cần điền họ tên';
			} else {
				$hoten = $_POST['hoten'];
			}

            if (empty($_POST['email'])) {
			} else {
				$email = $_POST['email'];
			}
            if (empty($_POST['phonenumber'])) {
			} else {
				$phonenumber = $_POST['phonenumber'];
			}
 
            if (empty($_POST['role'])) {
			} else {
				$role = $_POST['role'];
			}

			if ($username && $password && $hoten) {
				$check = $userModel->checkExists($username);

				if ($check->num_rows > 0) {
					$error['username_exist'] = '* Tên đăng nhập đã bị trùng';
				} else {
					$userModel->signup($username, $password, $hoten, $email, $phonenumber, $avatar, $role);
					echo "<script>alert('Thêm thành công')</script>";
				}
			}
			
		}

		return $error;
	}
}
if(isset($_SESSION['teacher'])){
	$header = new Header();
}
