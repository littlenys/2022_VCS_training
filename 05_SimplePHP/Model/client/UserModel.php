<?php
require_once("./Model/Database.php");
class UserModel extends Database{
	protected $db;

	public function __construct()
	{
		$this->db = new Database();
		$this->db->connect();
	}

	public function signup($username, $password, $hoten, $email, $phonenumber, $avatar, $role)
	{
		$sql = "INSERT INTO users (username, password, hoten, email, phonenumber, avatar, role)
					VALUES ('$username', '$password', '$hoten', '$email', '$phonenumber', '$avatar', '$role')";
		$this->db->conn->query($sql);
	}

	public function checkExists($username) {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $this->db->conn->query($sql);
		
		return $result;
	}

	public function login($username, $password)
	{
		$sql ="SELECT * FROM users WHERE username = '$username' and password = '$password'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	function getallstudents()
	{
		$sql = "SELECT * FROM users WHERE role = 'student'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	function deletestudent($role,$id)
	{
		if ($role = 'teacher')
		{
			$sql1 = "SELECT * FROM users WHERE id = '$id'";
			$sql2 = "DELETE FROM users WHERE id = '$id'";
			$result1 = $this->db->conn->query($sql1);
			$result2 = $this->db->conn->query($sql2);
			return $result1;
		}
	}

	function readuser($id)
	{
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$result = $this->db->conn->query($sql);
		return $result;
	}
 


}