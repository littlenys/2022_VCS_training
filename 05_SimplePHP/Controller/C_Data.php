
<?php
require_once('Controller/C_Base.php');

class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function error()
  {
    $this->render('error');
  }

  public function create()
  {
    $this->render('create');
  }

  public function read()
  {
    $this->render('read');
  }
  
  public function update()
  {
    $this->render('update');
  }

  public function delete()
  {
    $this->render('delete');
  }

}