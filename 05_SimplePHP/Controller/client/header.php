<?php
// class Header {
// 	public function __construct()
// 	{
// 		require('Model/client/UserModel.php');

// 		$userModel = new UserModel();
		// $error = $this->signUp($userModel);

// 		require('View/client/layouts/header.php');
// 	} // end __construct

// 	public function signUp($userModel) {
// 		$username = $password = $fullName = NULL;
// 		$error = array();
// 		$error['username'] = $error['password'] = $error['full_name'] = $error['username_exist'] = NULL;

// 		if (isset($_POST['signup'])) {
// 			if (empty($_POST['username'])) {
// 				$error['username'] = '* Cần điền tên đăng nhập';
// 			} else {
// 				$username = $_POST['username'];
// 			}
// 			if (empty($_POST['password'])) {
// 				$error['password'] = '* Cần điền mật khẩu';
// 			} else {
// 				$password = md5(md5($_POST['password']));
// 			}
// 			if (empty($_POST['full_name'])) {
// 				$error['full_name'] = '* Cần điền họ tên';
// 			} else {
// 				$fullName = $_POST['full_name'];
// 			}

// 			if ($username && $password && $fullName) {
// 				$check = $userModel->checkExists($username);

// 				if ($check->num_rows > 0) {
// 					$error['username_exist'] = '* Tên đăng nhập đã bị trùng';
// 				} else {
// 					$userModel->signup($username, $password, $fullName);
// 					echo "<script>alert('đăng ký thành công')</script>";
// 				}
// 			}
			
// 		}
// 		return $error;
// 	} // end signUp

// 	public function loginAdmin($userModel)
//     {
// 		$username = $password = NULL;
// 		$error = array();
// 		$error['username'] = $error['password']= $error['username_not_exist'] = NULL;

// 		if (isset($_POST['signup'])) {
// 			if (empty($_POST['username'])) {
// 				$error['username'] = '* Cần điền tên đăng nhập';
// 			} else {
// 				$username = $_POST['username'];
// 			}
// 			if (empty($_POST['password'])) {
// 				$error['password'] = '* Cần điền mật khẩu';
// 			} else {
// 				$password = md5(md5($_POST['password']));
// 			}
// 			if (empty($_POST['full_name'])) {
// 				$error['full_name'] = '* Cần điền họ tên';
// 			} else {
// 				$fullName = $_POST['full_name'];
// 			}

// 			if ($username && $password && $fullName) {
// 				$check = $userModel->checkExists($username);

// 				if ($check->num_rows = 0) {
// 					$error['username_not_exist'] = '* Tên đăng nhập không tồn tại';
// 				} else {
// 					$userModel->login($username, $password);
// 					echo "<script>alert('đăng ký thành công')</script>";
// 				}
// 			}
			
// 		}
// 		return $error;
//     } // end Login
// }
// $header = new Header();

?>