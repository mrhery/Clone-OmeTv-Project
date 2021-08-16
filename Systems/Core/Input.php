<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class Input{
	public function __construct(){}
	
	public static function get($name, $html = true){
		if(isset($_GET[$name])){
			if($html){
				return !is_array($_GET[$name]) ? htmlspecialchars($_GET[$name]) : $_GET[$name];
			}else{
				return !is_array($_GET[$name]) ? ($_GET[$name]) : $_GET[$name];
			}
		}else{
			return "";
		}
	}
	
	public static function post($name, $html = true){
		if(isset($_POST[$name])){
		    if($html){
		        return !is_array($_POST[$name]) ? htmlspecialchars($_POST[$name]) : $_POST[$name];
		    }else{
		        return !is_array($_POST[$name]) ? ($_POST[$name]) : $_POST[$name];
		    }
		}else{
			return "";
		}
	}
}
?>