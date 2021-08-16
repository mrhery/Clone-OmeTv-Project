<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class Encoder{
	public static function StringToHex($string){
		$hex = '';
	    for ($i=0; $i<strlen($string); $i++){
	        $ord = ord($string[$i]);
	        $hexCode = dechex($ord);
	        $hex .= "";
	        $hex .= substr('0'.$hexCode, -2);
	    }
	    return strToUpper($hex);
	}
	
	public static function HexToString(){
		//$hex = str_replace("/XAC", "", $hex);
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2){
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}
}

?>