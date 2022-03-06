<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$list = $this->GetAllSubmission($userModel);
		require_once('../05_SimplePHP/View/layouts/classes/getlistsubmission.php');
	}

	public function GetAllSubmission($userModel) 
    {
	    $list = $userModel->getlistsubmission();
        return $list;
    }
}

if(isset($_SESSION['teacher']))
{
    $header = new Header();
}
