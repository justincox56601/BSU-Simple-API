<?php
/**
 * this class deals directly with talking with the Database
 * This is the ONLY object that is allowed to talk with the DB
 * This is a singleton
 */

class Database{
	private $host = 'localhost';
	private $dbName = 'myDbName';
	private $user = 'root';
	private $password = 'password';
	private $conn = NULL;

	private static $instance = NULL;
	private $fake_database = array(
		[
			'title' => "My First post",
			'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis veniam deleniti ipsam! Reprehenderit enim ut aperiam quisquam eaque sunt sit itaque libero debitis? Est, iste.',
			'author'=> 'John Jackson'
		],
		[
			'title' => "My Second post",
			'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis veniam deleniti ipsam! Reprehenderit enim ut aperiam quisquam eaque sunt sit itaque libero debitis? Est, iste.',
			'author'=> 'Julie'
		],
		[
			'title' => "My Third post",
			'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis veniam deleniti ipsam! Reprehenderit enim ut aperiam quisquam eaque sunt sit itaque libero debitis? Est, iste.',
			'author'=> 'Frank'
		],
	);
	
	private function __construct(){
		return;
	}

	public static function  getInstance(){
		if(self::$instance == NULL){
			self::$instance = new Database();
		}
		return self::$instance;
	}

	private function connect(){
		//Check if a connection already exists
		if($this->conn != NULL){
			return $this->conn;
		}

		//Create a new connection
		try{
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->user, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo 'Connection Error: ' . $e->getMessage();
		}

		return $this->conn;
	}

	public function getPosts($query){
		/* $conn = $this->connect();
		$stmt = $conn->prepare($query);
		$stmt->execute();
		return $stmt; */

		return $this->fake_database;
	}
}