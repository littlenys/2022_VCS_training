<?php

class Entity_Student
{
    public $id;
    public $name;
    public $email;
    public $phonenumber;

    public function __construct($_id, $_name, $_email, $_phonenumber)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->phonenumber = $_phonenumber;
    }

}
?>