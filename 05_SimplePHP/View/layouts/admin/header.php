<?php
if(isset($_SESSION['teacher']))
{
    echo 'Hello '.$_SESSION['teacher']['hoten'].' teacher. Welcome to your class';
}
if(isset($_SESSION['student']))
{
    echo 'Hello '.$_SESSION['student']['hoten'].' student. Welcome to your class';
}
?>