<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class Char{
	public function __construct(){}
	
	public static function ValidString($string){
		$pattent = '/[\/:*?<>"|]/i';
		
		if(preg_match($pattent, ($string)) < 1){
			return true;
		}
		
		return false;
	}
}

?>