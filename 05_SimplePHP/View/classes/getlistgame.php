<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
		$list = $this->GetAllGame($userModel);
        $isresultcorrect = Null;
        if (!empty($_POST['submit']))
        {
            $isresultcorrect = $this->Answer($userModel);
        }
		require_once('../05_SimplePHP/View/layouts/classes/getlistgame.php');
   
	}

	public function GetAllGame($userModel) 
    {
	    $list = $userModel->getlistgame();
        return $list;
    }
    
    public function Answer($userModel) 
    {
        $id = NULL;
        $id = $_POST['id'];
        $answer = $_POST['answer'];
        $game = $userModel->getresultgame($id)->fetch_array();
        if ( md5($answer) == $game['tenfile']){
            return "Correct - ".file_get_contents($game['url']);
        }
        else{
            return "Incorrect";
        }

	}

}

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
