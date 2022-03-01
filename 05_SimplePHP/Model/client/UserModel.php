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
		$sql ="SELECT ID,role FROM users WHERE username = '$username' and password = '$password'";
		$result = $this->db->conn->query($sql);
		return $result;
	}
}