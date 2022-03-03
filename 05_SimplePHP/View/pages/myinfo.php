<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');
		require_once('../05_SimplePHP/View/layouts/client/myinfo.php');
	}
}
if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
