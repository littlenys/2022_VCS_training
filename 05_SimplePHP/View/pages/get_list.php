<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->GetAllStudent($userModel);

		require_once('../05_SimplePHP/View/layouts/client/get_list.php');
	}

	public function GetAllStudent($userModel) {

	$list = $userModel->getallstudents();
    
    }            
}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
