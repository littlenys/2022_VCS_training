<?php
include_once("../Model/M_Student.php");

//1. Declaration
class Ctrl_Student
{
    public function invoke(){
        if(isset($_GET['stid'])){
            $modelStudent = new Model_Student();
            $student = $modelStudent->getStudentDetail($_GET['stid']);

            include_once("../View/StudentDetail.html");
        }
        else{
            $modelStudent = new Model_Student();
            $studentList = $modelStudent->getAllStudent();

            include_once("../View/StudentList.html");
        }

    }
}

//2. Process
$C_student = new Ctrl_Student();
$C_student->invoke();

?>