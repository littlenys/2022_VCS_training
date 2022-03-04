<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$error = $this->GetAllStudent($userModel);
        if (!empty($_POST['delete']) && isset($_SESSION['teacher']))
        {
            $error = $this->DeleteStudent($userModel);
        }
        if (!empty($_POST['read']))
        {
            $error = $this->ReadStudent($userModel);
        }

        if (!empty($_POST['update']))
        {
            $error = $this->UpdateStudent($userModel);
        }
		require_once('../05_SimplePHP/View/layouts/client/get_list.php');
	}

	public function GetAllStudent($userModel) 
    {
	    $list = $userModel->getallstudents();
    }
    
    public function DeleteStudent($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
        $result = $userModel->deletestudent($_SESSION['teacher']['role'], $id)->fetch_array();
        $name= $result['hoten'];
        echo "<script>alert('Đã xóa sinh viên $name')</script>";
        header('Location: index.php?controller=pages&action=get_list');
	}

    public function ReadStudent($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
        $result = $userModel->readuser($id)->fetch_array();
        header('Location: index.php?controller=pages&action=profile&id='.$result['id']);
	}

    
    public function UpdateStudent($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
        $result = $userModel->readuser($id)->fetch_array();
        header('Location: index.php?controller=pages&action=editstudent&id='.$result['id']);
	}
}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
