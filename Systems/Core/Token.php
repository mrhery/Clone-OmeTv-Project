<?php

class Token{
	public static function create($name, $prefix = ""){
		$__token = $prefix . F::Encrypt(F::UniqKey());
		@$_SESSION[$name] = hash("sha256", $__token);
		
		return $__token;
	}
	
	public static function exists($name){
		return isset($_SESSION[$name]) ? true : false;
	}
	
	public static function get($name){
		if(self::exists($name)){
			return $_SESSION[$name];
		}else{
			return null;
		}
	}
	
	public static function destroy($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
		
		return true;
	}
	
	public static function reload($name, $prefix = ""){
		return self::create($name, $prefix);
	}
	
	public static function match($name, $token){
		if(self::exists($name)){
			if(self::get($name) == hash("sha256", $token)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}

?>