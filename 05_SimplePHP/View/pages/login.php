<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->Login($userModel);

		require_once('../05_SimplePHP/View/layouts/client/login.php');
	}

	public function Login($userModel) {
        $username = $password = NULL;
		$error = array();
		$error['username'] = $error['password'] = NULL;

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

			if ($username && $password ){
				$user = $userModel->login($username, $password);
                if ($user->num_rows > 0){
                    $data = $user->fetch_array();
					if ($data['role'] == 'teacher') {
						$_SESSION['teacher'] = $data;
						unset($_SESSION['student']);
                        header('Location: index.php?controller=pages&action=home');
						echo "<script>alert('đăng nhap giao vien thành công')</script>";
                    } else {
                        $_SESSION['student'] = $data;
						unset($_SESSION['teacher']);
						echo "<script>alert('đăng nhap hoc sinh thành công')</script>";
                        header('Location: index.php?controller=pages&action=home');
						echo "<script>alert('đăng nhap hoc sinh thành công')</script>";
                    }
                } 
				else {
                    echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
                }

			}
			else{
				echo "<script>alert('Nhap lai')</script>";
			}
			
		}

		return $error;
	}
}
$header = new Header();