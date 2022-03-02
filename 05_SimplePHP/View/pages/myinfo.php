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
        $result = $userModel->deletestudent($_SESSION['teacher']['role'], $id);
        $name = $result['hoten'];
        if ($name!= NULL){
            echo "<script>alert('Đã xóa sinh viên $name')</script>";
        }
	}
}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
