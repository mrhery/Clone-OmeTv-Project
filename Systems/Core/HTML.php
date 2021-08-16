<?php

class html{
	public static function script($string = ""){
		?>
		<script>
			<?= $string ?>
		</script>
		<?php
	}
	
	public static function div($settings = array(), $elements = null){
		$str = "<div ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		
		$str .= "</div>";
		return $str;
	}
	
	public static function span($settings = array(), $elements = null){
		$str = "<span ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		
		$str .= "</span>";
		return $str;
	}
	
	public static function h($no = "1", $settings = array(), $elements = null){
		$str = "<h" . $no . " ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		$str .= "</h" . $no . ">";
		
		return $str;
	}
	
	public static function c($elem = "x", $settings = array(), $elements = null){
		$str = "<" . $elem . " ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		$str .= "</" . $elem . ">";
		
		return $str;
	}
	
	public static function p($settings = array(), $elements = null){
		$str = "<p ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		$str .= "</p>";
		
		return $str;
	}
	
	public static function form($settings = array(), $route, $elements = null){
		$str = "<form ";
		
		foreach($settings as $setting => $val){
			$str .= $setting . '="' . $val . '" ';
		}
		$str .= ">";
		
		if(!is_null($elements)){
			if(is_array($elements)){
				foreach($elements as $element){
					$str .= $element;
				}
			}else{
				$str .= $elements;
			}
		}
		
		$str .= "<input type='hidden' name='route' value='" . $route . "' />";
		$str .= "<input type='hidden' name='submit' value='" . $_SESSION["IR"] . "' /></form>";
		return $str;
	}
	
	public static function input($input = "text", $name, $settings = null){
		$label		= (isset($settings["label"]) ? $settings["label"] : "");
		$id			= (isset($settings["id"]) ? $settings["id"] : "");
		$value		= (isset($settings["value"]) ? $settings["value"] : "");
		$seperator	= (isset($settings["seperator"]) ? $settings["seperator"] : "");
		$str		= "";
		
		switch(strtolower($input)){
			case "text":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<input type='text' value='". $value . "' ";
			break;
			
			case "password":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<input type='password' value='". $value ."' ";
			break;
			
			case "button":
				$str .= "<button ";
			break;
			
			case "checkbox":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<input type='checkbox' value='". $value ."' ";
			break;
			
			case "radio":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<input type='radio' value='". $value ."' ";
			break;
			
			case "textarea":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<textarea ";
			break;
			
			case "select":
				$label = "<label for='". $id ."'>" . $label . "</label>";
				$str .= $label . $seperator . "<select ";
			break;
			
			case "option":
				$str .= "<option value='". $name ."' ";
			break;
			
			default:
				$str .= "/";
			break;
		}
		
		if($name == "submit"){
			die("You cannot put input name as 'submit' because 'submit' reserved by the framework.");
		}
		
		$str .= 'name="'. $name .'" ';
		
		if(!is_null($settings)){
			if(is_array($settings)){
				foreach($settings as $setting => $val){
					if($setting != "elements" && $setting != "element" && $setting != "label" && $setting != "seperator"){
						$str .= $setting .'="' . $val . '" ';
					}
				}
			}else{
				$str .= $settings . " ";
			}
		}
		
		switch(strtolower($input)){
			case "button":
				$str .= "> ";
				if(is_array($settings)){
					if(isset($settings["elements"])){
						if(is_array($settings["elements"])){
							foreach($settings["elements"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["elements"] must be in array.');
						}
					}
					
					if(isset($settings["element"])){
						if(is_array($settings["element"])){
							foreach($settings["element"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["element"] must be in array.');
						}
					}
					
					$str .= $label . "</button>";
				}else{
					$str .= ">". $label ."</button>";
				}
			break;
			
			case "textarea":
				$str .= ">". $value ."</textarea>";
			break;
			
			case "select":
				$str .= "> ";
				if(is_array($settings)){
					if(isset($settings["elements"])){
						if(is_array($settings["elements"])){
							foreach($settings["elements"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["elements"] must be in array.');
						}
					}
					
					if(isset($settings["element"])){
						if(is_array($settings["element"])){
							foreach($settings["element"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["element"] must be in array.');
						}
					}
					
					$str .= "</select>";
				}else{
					$str .= "></select>";
				}
			break;
			
			case "option":
				$str .= "> ";
				if(is_array($settings)){
					if(isset($settings["elements"])){
						if(is_array($settings["elements"])){
							foreach($settings["elements"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["elements"] must be in array.');
						}
					}
					
					if(isset($settings["element"])){
						if(is_array($settings["element"])){
							foreach($settings["element"] as $element){
								$str .= $element;
							}
						}else{
							die('setting["element"] must be in array.');
						}
					}
					
					$str .= $label . "</option>";
				}else{
					$str .= ">". $label ."</option>";
				}
			break;
			
			default:
				$str .= " />";
			break;
		}
		
		return $str;
	}
	
	public static function table($settings = [], $heads = [], $datas = [], $sets = []){
		$str = "<table ";
		
		if(is_array($settings)){
			foreach($settings as $setting => $val){
				$str .= $setting . '="' . $val . '" ';
			}
		}else{
			$str .= $settings;
		}
		$str .= ">";
		
		$str .= "
			<thead>
				<tr>
		";
		
		foreach($heads as $head){
			$str .= "<th>" . $head . "</th>";
		}
		
		$str .= "</tr>
			</thead>
		
			<tbody>
		";
		
		foreach($datas as $data){
			$str .= "<tr>";
			
			for($i = 0; $i < count($heads); $i++){
				$str .= "<td>" . $data[$i] . "</td>";
			}
			
			$str .= "</tr>";
		}
		
		$str .= "</tbody>
		";
		
		if(!in_array("nofooter", $sets)){
			$str .= "
				<tfoot>
					<tr>
			";
			
			foreach($heads as $head){
				$str .= "<td>" . $head . "</td>";
			}
			
			$str .= "</tr></tfoot>";
		}
		
		$str .="</table>";
		
		return $str;
	}
}


































?>