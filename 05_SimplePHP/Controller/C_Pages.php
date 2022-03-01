
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
}