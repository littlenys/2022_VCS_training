<?php
if(isset($_SESSION['teacher']))
{
    require_once('../05_SimplePHP/View/layouts/client/logon_header.php');
    require_once('../05_SimplePHP/View/layouts/client/logon_home_teacher.php');
    require_once('../05_SimplePHP/View/layouts/admin/header.php');
}
else if(isset($_SESSION['student']))
{
    require_once('../05_SimplePHP/View/layouts/client/logon_header.php');
    require_once('../05_SimplePHP/View/layouts/client/logon_home_student.php');
    require_once('../05_SimplePHP/View/layouts/admin/header.php');
}
else {
    require_once('../05_SimplePHP/View/layouts/client/login_header.php');
}
?>

<!-- TODO remove this. 'get_list','addstudent','editstudent','myinfo','profile' -->
<a href="?controller=pages&action=get_list">List student</a>
