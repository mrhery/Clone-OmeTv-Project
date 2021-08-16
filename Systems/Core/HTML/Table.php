<?php
namespace HTML;

class Table{
	public static function build($V_s = "", $V_e = null){
		${V."table"} = "<table" . $V_s . ">";
		
		if(!is_null($V_e)){
			if(is_array($V_e)){
				foreach($V_e as $V_a){
					${V."table"} .= $V_a;
				}
			}else{
				${V."table"} .= $V_a;
			}
		}
		
		${V."table"} .= "</table>";
		
		return ${V."table"};
	}
}