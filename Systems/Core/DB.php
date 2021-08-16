<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class DB{
	private static $_instance = null;
	private $_pdo, $_query, $_error = false, $_results, $_count = 0;
	
	private function __construct($conn = []){
		if(is_int($conn)){
			if(isset(self::database()[$conn])){
				$conn = self::database()[$conn];
			}else{
				$conn = count(self::database()) > 0 ? self::database()[0] : [];
			}
		}else{
			if(count($conn) < 4){
				$conn = count(self::database()) > 0 ? self::database()[0] : [];
			}
		}
		
		try{
			$this->_pdo = new PDO("mysql:host=" . $conn["host"] . "; dbname=" . $conn["database"], $conn["username"], $conn["password"]);
		}catch(PDOException $ex){
			die($ex->getMessage());
		}
	}
	
	public static function conn($conn = []){
		self::$_instance = new DB($conn);
		return self::$_instance;
	}
	
	public function query($sql, $params = []){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			$x = 1;
			if(count($params)){
				foreach($params as $param){
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}
	
	public function update($table, $where, $fields){
		$set = '';
		$x = 1;
		
		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ", ";
			}
			$x++;
		}
		
		$sql = "UPDATE {$table} SET {$set} WHERE {$where}";
		if($this->query($sql, $fields)){
			$this->_error = false;
		}else{
			$this->_error = true;
		}
		
		return $this;
	}
	
	public function insert($table, $fields = array()){
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			
			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields)){
					$values .= ',';
				}
				$x++;
			}
			
			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES({$values})";
			
			if($this->query($sql, $fields)){
				$this->_error = false;
			}
		}else{
			$this->_error = true;
		}
		
		return $this;
	}
	
	public function del($table, $column, $data){
		$sql = "DELETE FROM  {$table} WHERE {$column} = {$data}";
		if($this->_query = $this->_pdo->prepare($sql)){
			if($this->_query->execute()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function q($sql){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}
	
	public static function database(){
		$array = [];
		if(file_exists(APPS . APP_CODE. "/configure.json")){
			$json = file_get_contents(APPS . APP_CODE . "/configure.json");
			$obj = json_decode($json);
			
			if(isset($obj->databases)){
				foreach($obj->databases as $db){
					$array[] = [
						"database"	=> $db->database,
						"username"	=> $db->username,
						"password"	=> $db->password,
						"host"		=> $db->host
					];
				}
			}
		}
		
		return $array;
	}
	
	public function results(){
		return $this->_results;
	}
	
	public function error(){
		return $this->_error;
	}
	
	public function count(){
		return $this->_count;
	}
}
