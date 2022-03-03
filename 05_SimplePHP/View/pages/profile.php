<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
        $info = $this->GetInfo($userModel);
		require('../05_SimplePHP/View/layouts/client/profile.php');
	}

	public function GetInfo($userModel) 
    {
        $id = $_GET['id'];
	    $info = $userModel->readuser($id)->fetch_array();
        return $info;
    }
}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
