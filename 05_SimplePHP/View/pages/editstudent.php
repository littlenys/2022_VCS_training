<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
        $id = $_GET['id'];
		$error = $this->Edit($userModel);
	    $info = $userModel->readuser($id)->fetch_array();
		if (isset($_POST['exit'])) 
		{
			header('Location: index.php?controller=pages&action=get_list');
		}
		require_once('../05_SimplePHP/View/layouts/client/editstudent.php');
	}

	public function Edit($userModel) {
        $id = $_GET['id'];
        $username = $password = $hoten = $email = $phonenumber = $avatar = $role = NULL;
        $role = "student";
		$error = array();
		$error['username'] = $error['password'] = $error['hoten'] = $error['username_exist'] = $error['hoten'] = NULL;

		if (isset($_POST['Edit'])) {
			if (empty($_POST['username'])) {
				$error['username'] = '* Cần điền tên đăng nhập';
			} else {
				$username = $_POST['username'];
			}
            if (empty($_POST['password'])) {
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


			$userModel->updatestudent($id,$username, $password, $hoten, $email, $phonenumber);
			header('Location: index.php?controller=pages&action=get_list');
            } // end post edit
    }// end function edit
} // end header

if(isset($_SESSION['teacher']))
{
	$header = new Header();
}
