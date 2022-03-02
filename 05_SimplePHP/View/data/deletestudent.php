<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->Login($userModel);

		require_once('../05_SimplePHP/View/layouts/client/login.php');
	}

	public function Login($userModel) 
    {
        $id = NULL;

		if (isset($_POST['delete']) and isset($_SESSION['teacher'] ) 
        {
            $id = $_POST['id'];
            $result = $userModel->deletestudent($_SESSION['teacher']['role'], $id);
            $name = $result['hoten']
            echo "<script>alert('Đã xóa sinh viên $name')</script>";
        }
	}


$header = new Header();

