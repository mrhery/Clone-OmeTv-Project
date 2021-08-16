<?php
//load assets file

if(Url::get("main") == "assets"){
	$path = Url::get("path");
	
	Loader::Asset($path);
	die();
}
