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

	public function getallstudents()
	{
		$sql = "SELECT * FROM users WHERE role = 'student' AND is_deleted = false";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function deletestudent($role,$id)
	{
		if ($role = 'teacher')
		{
			$sql1 = "SELECT * FROM users WHERE id = '$id'";
			$sql2 = "UPDATE users SET is_deleted = true WHERE id = '$id'";
			$sql3 = "DELETE FROM users WHERE id = '$id'";
			$result1 = $this->db->conn->query($sql1);
			$result2 = $this->db->conn->query($sql2);
			return $result1;
		}
	}

	public function updatestudent($id,$username, $password, $hoten, $email, $phonenumber)
	{
		if ($password!=NULL){
			$sql = "UPDATE users 
			SET username = '$username', 
				password = '$password', 
				hoten = '$hoten', 
				email = '$email', 
				phonenumber = '$phonenumber'
			WHERE id = '$id'";
			$this->db->conn->query($sql);
		}
		else{
			$sql = "UPDATE users 
			SET username = '$username', 
				hoten = '$hoten', 
				email = '$email', 
				phonenumber = '$phonenumber'
			WHERE id = '$id'";
			$this->db->conn->query($sql);
		}

	}

	public function updatestudentforstudent($id, $password, $email, $phonenumber)
	{
		if ($password!=NULL){
			$sql = "UPDATE users 
			SET password = '$password', 
				email = '$email', 
				phonenumber = '$phonenumber'
			WHERE id = '$id'";
			$this->db->conn->query($sql);
		}
		else{
			$sql = "UPDATE users 
			SET email = '$email', 
				phonenumber = '$phonenumber'
			WHERE id = '$id'";
			$this->db->conn->query($sql);
		}

	}

	public function readuser($id)
	{
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function getmessage($idsend,$idrev)
	{
		$sql = "SELECT * FROM message WHERE idsend = '$idsend' AND idrev = '$idrev'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function sendmessage($idsend,$idrev,$noidung){
		$sql = "INSERT INTO message (idsend, idrev, noidung)
					VALUES ('$idsend', '$idrev', '$noidung')";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function deletemessage($id){
		$sql = "DELETE FROM message WHERE id = $id";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function updatemessage($id,$noidung){
		$sql = "UPDATE message
				SET noidung = '$noidung'
				WHERE id = '$id'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function updatestudentavatar($id,$avatar)
	{
		$sql = "UPDATE users 
		SET avatar = '$avatar'
		WHERE id = '$id'";
			$this->db->conn->query($sql);
	}

	public function addassignment($authorid,$name,$due)
	{
		$sql1 = "INSERT INTO assignment (authorid,name, due)
		VALUES ('$authorid','$name', '$due')";
		if ($this->db->conn->query($sql1) === TRUE){
			$last_id = $this->db->conn->insert_id; 
			return $last_id;
		}
		return NULL;
	}

	public function getlistassignment()
	{
		$sql = "SELECT * FROM assignment WHERE is_deleted = false";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function viewassignment($id)
	{
		$sql = "SELECT * FROM fileattach WHERE partid = '$id' AND part = 'assignment'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function addsubmission($authorid,$assigmentid)
	{
		$sql1 = "INSERT INTO submission (authorid,assignmentid)
		VALUES ('$authorid','$assigmentid')";
		if ($this->db->conn->query($sql1) === TRUE){
			$last_id = $this->db->conn->insert_id; 
			return $last_id;
		}
		return NULL;
	}


	public function viewsubmission($id)
	{
		$sql = "SELECT * FROM fileattach WHERE partid = '$id' AND part = 'submission'";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function getlistsubmission()
	{
		$sql = "SELECT * FROM submission WHERE is_deleted = false";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function addgame($authorid,$goiy)
	{
		$sql1 = "INSERT INTO game (authorid,goiy)
		VALUES ('$authorid','$goiy')";
		if ($this->db->conn->query($sql1) === TRUE){
			$last_id = $this->db->conn->insert_id; 
			return $last_id;
		}
		return NULL;
	}

	public function getlistgame()
	{
		$sql = "SELECT * FROM game WHERE is_deleted = false";
		$result = $this->db->conn->query($sql);
		return $result;
	}

	public function getresultgame($id)
	{
		$sql = "SELECT * FROM fileattach WHERE partid = '$id' AND part = 'game'";
		$result = $this->db->conn->query($sql);
		return $result;
	}


	public function fileattach($part, $partid, $tenfile, $url)
	{
		$sql = "INSERT INTO fileattach (part, partid, tenfile, url)
		VALUES ('$part', '$partid', '$tenfile', '$url')";
		$result = $this->db->conn->query($sql);
		return $result;
	}
}