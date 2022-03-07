
<?php
require_once('Controller/C_Base.php');

class ClassesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'classes';
  }

  public function error()
  {
    $this->render('error');
  }

  
  public function home()
  {
    $this->render('home');
  }

  public function addassignment()
  {
    $this->render('addassignment');
  }

  public function getlistassignment()
  {
    $this->render('getlistassignment');
  }

  public function viewassignment()
  {
    $this->render('viewassignment');
  }
  public function getlistsubmission()
  {
    $this->render('getlistsubmission');
  }

  public function addgame()
  {
    $this->render('addgame');
  }

  public function getlistgame()
  {
    $this->render('getlistgame');
  }
  
}