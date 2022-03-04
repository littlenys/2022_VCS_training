
<?php
require_once('Controller/C_Base.php');

class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
    $data = array(
      'name' => 'Sang Beo',
      'age' => 22
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }

  public function login()
  {
    $this->render('login');
  }
  public function signup()
  {
    $this->render('signup');
  }

  public function logout()
  {
    $this->render('logout');
  }
  public function get_list()
  {
    $this->render('get_list');
  }

  public function addstudent()
  {
    $this->render('addstudent');
  }

  public function editstudent()
  {
    $this->render('editstudent');
  }

  public function myinfo()
  {
    $this->render('myinfo');
  }

  public function profile()
  {
    $this->render('profile');
  }
  
}