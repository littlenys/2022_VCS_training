<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->LogOut($userModel);
	}

	public function LogOut($userModel) {
        session_destroy();
        header('Location: index.php?controller=pages&action=home');
    }
}
$header = new Header();