<?php

class Turbo{
	private static $instance = null, $app_code = "";
	public static $configure;
	
	public function __construct(){
		if(!file_exists(APPS . self::$app_code . "/configure.json")){
			throw new Exception("Configuration file not found or " . self::$app_code . " project is not correctly created.");
		}
		
		$json = file_get_contents(APPS . self::$app_code . "/configure.json");
		$obj = json_decode($json);
		
		self::$configure = $obj;
		return $this;
	}
	
	public static function App($app_code = ""){
		if(empty($app_code)){
			throw new Exception("Please insert Application Code when using Turbo::App() method.");
		}
		
		self::$app_code = $app_code;
		
		if(!isset(self::$instance)){
			self::$instance = new Turbo($app_code);
		}
		
		return self::$instance;
	}
	
	public static function Constants($name = ""){
		if(empty($name)){
			throw new Exception("Insert constant name when using Contants() method.");
		}
		
		$r = null;
		if(isset(self::$configure->constants)){
			foreach(self::$configure->constants as $constant){
				if(isset($constant->{$name})){
					$r = $constant->{$name};
					break;
				}
			}
		}
		
		return $r;
	}
	
	public static function View($path = ""){
		if(empty($path)){
			throw new Exception("Path is not set in View() mehtod.");
		}
		
		if(file_exists(APPS . self::$app_code . "/View/" . $path)){
			include_once(APPS . self::$app_code . "/View/" . $path);
		}
	}
	
	public static function Classes($path = ""){
		if(empty($path)){
			throw new Exception("Path is not set in View() mehtod.");
		}
		
		if(file_exists(APPS . self::$app_code . "/Classes/" . $path)){
			include_once(APPS . self::$app_code . "/Classes/" . $path);
		}
	}
	
	public static function Controller($path = ""){
		if(empty($path)){
			throw new Exception("Path is not set in View() mehtod.");
		}
		
		if(file_exists(APPS . self::$app_code . "/Controller/" . $path)){
			include_once(APPS . self::$app_code . "/Controller/" . $path);
		}
	}
}

