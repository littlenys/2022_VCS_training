<?php

class Database
{
	public $conn = NULL;
	private $server = 'localhost';
	private $dbName = '05_simplephp';
	private $user = 'root';
	private $password = '';
        
        // Hàm kết nối CSDL
	public function connect()
	{
		$this->conn = new mysqli($this->server, $this->user, $this->password, $this->dbName);

		if ($this->conn->connect_error) {
			printf($this->conn->connect_error);
			exit();
		}
		$this->conn->set_charset("utf8");
	}
        // Hàm đóng kết nối CSDL
        public function closeDatabase()
	{
		if ($this->conn) {
			$this->conn->close();
		}
	}
}