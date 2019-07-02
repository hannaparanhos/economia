<?php 

class Database{

    private $host = '127.0.0.1';
	private $user = 'root';
	private $db_name = 'bdeconomia';
	private $pass = '1234';
    public $conn;

	public function connection(){

		$this->conn = null;

		try {
            $this->conn = new PDO("mysql:host=" . $this->host .  ";dbname=" . $this->db_name, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
	}

}