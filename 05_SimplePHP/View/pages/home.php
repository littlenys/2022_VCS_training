<?php
if(isset($_SESSION['teacher']))
{
    require_once('../05_SimplePHP/View/layouts/client/logon_header.php');
    require_once('../05_SimplePHP/View/layouts/admin/header.php');
}
else if(isset($_SESSION['student']))
{
    require_once('../05_SimplePHP/View/layouts/client/logon_header.php');
    require_once('../05_SimplePHP/View/layouts/admin/header.php');
}
else {
    require_once('../05_SimplePHP/View/layouts/client/login_header.php');
}
?>