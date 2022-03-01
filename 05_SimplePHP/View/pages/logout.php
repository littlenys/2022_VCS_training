<?php

class Header {
	public function __construct()
	{
		$error = $this->LogOut($userModel);
	}

	public function LogOut($userModel) {
        session_destroy();
        header('Location: index.php?controller=pages&action=home');
    }
}
$header = new Header();