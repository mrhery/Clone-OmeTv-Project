<?php

trait Modelv2{
	private static $table = __CLASS__;
	
	//Query Builder Start
	private static $instance = null;
	private static $select = "", $where = [], $limit = "", $order = "", $group = "", $having = [];
	public function __construct(){
		
	}
	
	public static function select($sel = "*"){
		$class = __CLASS__;
		self::$instance = new $class();
		self::$select = $sel;
		return self::$instance;
	}
	
	public function where($where = []){
		self::$where = $where;
		
		return $this;
	}
	
	public function having($having = []){
		self::$having = $having;
		
		return $this;
	}
	
	public function limit($limit = ""){
		self::$limit = $limit;
		
		return $this;
	}
	
	public function groupBy($group = ""){
		self::$group = $group;
		
		return $this;
	}
	
	public function orderBy($order = ""){
		self::$order = $order;
		
		return $this;
	}
	
	public function fetch(){
		$sql = "SELECT " . self::$select . " FROM " . self::$table . " ";
		$bind = [];
		
		if(count(self::$where) > 0){
			$sql .= "WHERE ";
			$i = 0;
			foreach(self::$where as $key => $value){
				$bind[] = $value;
				if($i == 0){
					$sql .= " " . $key . " = ?";
				}else{
					$sql .= " AND " . $key . " = ?";
				}
				
				$i++;
			}
		}
		
		if(!empty(self::$group)){
			$sql .= " GROUP BY " . self::$group;
		}
		
		if(count(self::$having) > 0){
			$sql .= "HAVING ";
			$i = 0;
			foreach(self::$having as $key => $value){
				$bind[] = $value;
				if($i == 0){
					$sql .= " " . $key . " = ?";
				}else{
					$sql .= " AND " . $key . " = ?";
				}
				
				$i++;
			}
		}
		
		if(!empty(self::$order)){
			$sql .= " ORDER BY " . self::$order;
		}
		
		if(!empty(self::$limit)){
			$sql .= " LIMIT " . self::$limit;
		}
		
		return DB::conn()->query($sql, $bind)->results();
	}
	
	//Query Builder End
	
	public static function list($setting = array()){
		$sql = "SELECT ";
		
		if(isset($setting["column"])){
			$sql .= $setting["column"] . " FROM ";
		}else{
			$sql .= "* FROM ";
		}
		
		if(empty(self::$table)){
			if(isset($setting["table"]) AND !empty($setting["table"])){
				$sql .= $setting["table"];
			}else{
				return false;
			}
		}else{
			$sql .= self::$table;
		}
		
		if(isset($setting["where"]) AND !empty($setting["where"])){
			$sql .= " WHERE " . $setting["where"];
		}
		
		if(isset($setting["group"]) AND !empty($setting["group"])){
			$sql .= " GROUP BY " . $setting["group"];
		}
		
		if(isset($setting["order"]) AND !empty($setting["order"])){
			$sql .= " ORDER BY " . $setting["order"];
		}
		
		if(isset($setting["limit"]) AND !empty($setting["limit"])){
			$sql .= " LIMIT " . $setting["limit"];
		}
		
		$x = DB::conn()->q($sql);
		
		$datas = [];
		foreach($x->results() as $values){
			$data = (object)[];
			foreach($values as $key => $value){
				$data->{$key} = call_user_func(function($val){
					return F::StringChar($val);
				}, $value);
			}
			
			$datas[] = $data;
		}
		
		return $datas;
	}
	
	public static function count($column = []){
		$sql = "SELECT COUNT(*) as number FROM " . self::$table . " ";
	    $s = false;
	    
		if(count($column) > 0){
			$sql .= "WHERE ";
		}
		
		$i = 0;
		foreach($column as $key => $value){
			if($i == 0){
				$sql .= " " . $key . " = ?";
			}else{
				$sql .= " AND " . $key . " = ?";
			}
			
			$i++;
		}
		
		$x = DB::conn()->query($sql, $column)->results();
		
		if(count($x) > 0){
			return $x[0]->number;
		}else{
			return 0;
		}
	}
	
	public static function getBy($column, $setting = []){
		$sql = "SELECT * FROM " . self::$table . " WHERE";
	    $s = false;
	    
		$i = 0;
		foreach($column as $key => $value){
			if($i == 0){
				$sql .= " " . $key . " = ?";
			}else{
				$sql .= " AND " . $key . " = ?";
			}
			
			$i++;
		}
		
		foreach($setting as $key => $value){
		    switch($key){
		        case "order":
		            $sql .= " ORDER BY " . $value;    
		        break;
		        
		        case "limit":
		            $sql .= " LIMIT " . $value;
		        break;
		    }
		}
		
		$x = DB::conn()->query($sql, $column);
		
		if($s){
			$datas = [];
			foreach($x->results() as $values){
				$data = (object)[];
				foreach($values as $key => $value){
					$data->{$key} = call_user_func(function($val){
						return F::StringChar($val);
					}, $value);
				}
				
				$datas[] = $data;
			}
			
			return $datas;
		}else{
			return $x->results();
		}
		/**/
		
	}
	
	public static function insertInto($data){
		$x = DB::conn()->insert(self::$table, $data);
		
		return ($x->error() ? false : true);
	}
	
	public static function deleteBy($data){
		$sql = "DELETE FROM " . self::$table . " WHERE";
		
		$i = 0;
		foreach($data as $key => $value){
			if($i == 0){
				$sql .= " " . $key . " = ? ";
			}else{
				$sql .= " AND " . $key . " = ?";
			}
			
			$i++;
		}
		
		$x = DB::conn()->query($sql, $data);
		
		return ($x->error() ? false : true);
	}
	
	public static function updateBy($where, $data){
		$sql = "UPDATE " . self::$table . " SET ";
		
		$i = 1;
		foreach($data as $key => $value){
			$sql .= " " . $key . " = ?";
			if($i < count($data)){
				$sql .= ", ";
			}
			
			$i++;
		}
		
		$sql .= " WHERE ";
		
		$i = 0;
		foreach($where as $key => $value){
			if($i == 0){
				$sql .= " " . $key . " = ?";
			}else{
				$sql .= " AND " . $key . " = ?";
			}
			
			$data[$key] = $value;
			$i++;
		}
		
		$x = DB::conn()->query($sql, $data);
		
		return ($x->error() ? false : true);
	}
}



















