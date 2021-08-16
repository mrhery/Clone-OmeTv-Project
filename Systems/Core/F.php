<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class F{
	public function __construct(){	}
	
	public static function URLEncode($url){
		return urlencode($url);
	}
	
	public static function URLDecode($url, $cpecialChar = false){
		if($specialChars == true){
			$url = self::HTMLChars($url);
		}
		return urldecode($url);
	}
	
	public static function URLSlugEncode($url){
		$url = str_replace("-", "x00", $url);
		$url = str_replace(" ", "-", $url);
		$url = str_replace("&", "x01", $url);
		$url = str_replace("?", "x02", $url);
		$url = str_replace("#", "x03", $url);
		$url = str_replace("/", "x04", $url);
		$url = str_replace("\\", "x05", $url);
		
		return $url;
	}
	
	public static function URLSlugDecode($url, $specialChars = false){
		$url = str_replace("-", " ", $url);
		$url = str_replace("x00", "-", $url);
		$url = str_replace("x01", "&", $url);
		$url = str_replace("x02", "?", $url);
		$url = str_replace("x03", "#", $url);
		$url = str_replace("x04", "/", $url);
		$url = str_replace("x05", "\\", $url);
		
		if($specialChars == true){
			$url = htmlspecialchars($url);
		}
		return $url;
	}
	
	public static function StringChar($str){
		return htmlspecialchars($str);
	}
	
	public static function Encode64($string){
		return base64_encode($string);
	}
	
	public static function Decode64($string){
		return base64_decode($string);
	}
	
	public static function Extract($method){
		$json = json_encode($method);
		return json_decode($json);
	}
	
	public static function Encrypt($string = ""){
		$salt = "5a7347f6fda4a346760af782d2ec126f7b9873ea9a7f2bb1fee9abdfd5f4dfc9";
		$string = $string . $salt;
		return hash("sha256", $string);
	}
	
	public static function Hashing($string = "", $type = "sha256"){
		$salt = '5a7347f6fda4a346760af782d2ec126f7b9873ea9a*&(*9yad09707d0a7d0ad!@#!@#!#!#!$#!$!$!#$!$!$!$!$!%@$%#&&*^(7f2bb1fee9abdfd5f4dfc9';
		$string = $string . $salt;
		return hash($type, $string);
	}
	
	public static function UniqKey($prefix = ""){
		return $prefix . uniqid();
	}
	
	public static function UniqId($length = 8){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= $number = "0123456789";
		$max = strlen($codeAlphabet);

		for ($i=0; $i < $length - 3; $i++) {
			$token .= $codeAlphabet[random_int(0, $max-1)];
		}
		
		for ($i=0; $i < 3; $i++) {
			$token .= $number[random_int(0, strlen($number) - 1)];
		}

		return $token;
	}

	
	public static function GetDate($time = 0, $full = false){
		if($time < 1){
			$time = time() + 28800;
		}else{
			$time = time() + $time;
		}
		
		if($full){
			$date = gmdate("d-M-Y H:i:s\ ", $time);
		}else{
			$date = date("d-M-Y", $time);
		}
		return $date;
	}
	
	public static function GetTime($date = ""){
		if(empty($date)){
			$time = time() + 28800;
		}else{
			$time = strtotime($date);
		}
		return $time;
	}
	
	public static function URLParams($encode = false){
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	
	public static function TrimWord($string, $limit){
		if (strlen($string) > $limit){
			$string = substr($string, 0, $limit) . ' ...';
		}
		return $string;
	}
	
	public static function ObjInArray($array, $index, $value)
    {
        foreach($array as $arrayInf) {
            if($arrayInf->{$index} == $value) {
                return $arrayInf;
            }
        }
        return null;
    }
    
    public static function String($string){
    	return htmlspecialchars($string);
    }
    
    #UplodImage() Method
    #This method is an automatic resizing the vector and quality for uploaded image
    #
    #How to use?
    #
    #	$pathinfo = pathinfo($_FILES["file"]["name"]);
    #	$bool = F::UploadImage($_FILES["file"]["tmp_name"], "path/to/upload", $pathinfo["extension"], 550, 368);
    #
    public static function UploadImage($temp, $path, $file_type, $dw = "", $dh = "", $q = 90){
    	$source_image = FALSE;
    	
		if(preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)){
			if(!$source_image = @imagecreatefromjpeg($temp)){
				return false;
			}
		}elseif(preg_match("/png|PNG/", $file_type)){
			if(!$source_image = @imagecreatefrompng($temp)){
				return false;
			}
		}elseif(preg_match("/gif|GIF/", $file_type)){
			if(!$source_image = @imagecreatefromgif($temp)){
				return false;
			}
		}else{
			return false;
		}
		
		$ow = imageSX($source_image);
		$oh = imageSY($source_image);
		
		if(empty($dw) OR empty($dh)){
    		$dw = $ow;
    		$dh = $oh;
    	}
		
		$o_aspect = $ow / $oh;
		$d_aspect = $dw / $dh;
		
		
		if($o_aspect >= $d_aspect){
			$n_width = $dw;
			$n_height = $oh / ($ow / $dw);
		}else{
			$n_height = $dh;
			$n_width = $ow / ($oh / $dh);
		}
		
		$virtual_image = imagecreatetruecolor($dw, $dh);
		
		if(preg_match("/png|PNG/", $file_type)){
			imagesavealpha($virtual_image, true);
			$color = imagecolorallocatealpha($virtual_image, 0, 0, 0, 127); //transparent color
			imagefill($virtual_image, 0, 0, $color);
			imagecopyresampled($virtual_image, $source_image, (0 - ($n_width - $dw) / 2), (0 - ($n_height - $dh) / 2), 0, 0, $n_width, $n_height, $ow, $oh);
			
			if (@imagepng($virtual_image, $path)) {
				imagedestroy($virtual_image);
				imagedestroy($source_image);
				return true;
			} else {
				return false;
			}
		}
		
		$kek = imagecolorallocate($virtual_image, 255, 255, 255);
		imagefill($virtual_image, 0, 0, $kek);
		
		$con = imagecopyresampled($virtual_image, $source_image, (0 - ($n_width - $dw) / 2), (0 - ($n_height - $dh) / 2), 0, 0, $n_width, $n_height, $ow, $oh);
	
		
		if (@imagejpeg($virtual_image, $path, $q)) {
			imagedestroy($virtual_image);
			imagedestroy($source_image);
			return true;
		} else {
			return false;
		}
    }
}

?>