<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$list = $this->GetAllAssignment($userModel);

        if (!empty($_POST['read']))
        {
            $error = $this->ReadAssignment($userModel);
        }
		require_once('../05_SimplePHP/View/layouts/classes/getlistassignment.php');
	}

	public function GetAllAssignment($userModel) 
    {
	    $list = $userModel->getlistassignment();
        return $list;
    }
    
    public function ReadAssignment($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
        header('Location: index.php?controller=classes&action=viewassignment&id='.$id);
	}

}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
