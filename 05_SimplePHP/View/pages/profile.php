<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
        $info = $this->GetInfo($userModel);
		$messages = $this->GetMessage($userModel);
		if (!empty($_POST['message'])){
			$messagesend = $this->SendMessage($userModel);
			header("Refresh:0");
		}
		if (!empty($_POST['delete'])){
			$messagedelete = $this->DeleteMessage($userModel);
			header("Refresh:0");
		}
		if (!empty($_POST['update'])){
			$messageupdate = $this->UpdateMessage($userModel);
			header("Refresh:0");
		}

		require('../05_SimplePHP/View/layouts/client/profile.php');
	}

	public function GetInfo($userModel) 
    {
        $id = $_GET['id'];
	    $info = $userModel->readuser($id)->fetch_array();
        return $info;
    }

	public function GetMessage($userModel) 
    {
        $idrev = $_GET['id'];
		if(isset($_SESSION['teacher']))
		{
			$idsend= $_SESSION['teacher']['id'];
		}
		if(isset($_SESSION['student']))
		{
			$idsend= $_SESSION['student']['id'];
		}
	    $messages = $userModel->getmessage($idsend,$idrev);
        return $messages;
    }

	public function SendMessage($userModel){
		$message = $_POST['message'];
		$idrev = $_GET['id'];
		if(isset($_SESSION['teacher']))
		{
			$idsend= $_SESSION['teacher']['id'];
		}
		if(isset($_SESSION['student']))
		{
			$idsend= $_SESSION['student']['id'];
		}
		$messagesend = $userModel->sendmessage($idsend,$idrev,$message);
	}

	public function DeleteMessage($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
		$messagedelete = $userModel->deletemessage($id);

	}

	public function UpdateMessage($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
		$noidungupdate = $_POST['noidungupdate'];
		$messagedelete = $userModel->updatemessage($id,$noidungupdate);

	}
}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
