<?php


switch(input::post("action")){
	case "login":
		$u = users::getBy(["u_login" => Input::post("username"), "u_password" => F::Encrypt(Input::post("password"))]);
		
		if($u){
			$u = $u[0];
			
			$_SESSION["user_login"] = $u->u_login;
			$_SESSION["user_id"] = $u->u_id;
			$_SESSION["user_gender"] = $u->u_gender;
			$_SESSION["user_for"] = $u->u_for;
			$_SESSION["user_peer"] = $u->u_peer;
			$_SESSION["user_key"] = $u->u_key;
			
			users::updateBy([
				"u_id"	=> $u->u_id
			],[
				"u_waiting" => 1,
				"u_with"	=> 0
			]);
			
			header("Location: " . PORTAL);
		}else{
			new Alert("error", "Username or password is not valid.");
		}
	break;
	
	case "register":
		$u = users::getBy(["u_email" => input::post("email")]);
		
		if(count($u) > 0){
			new Alert("error", "Email has been use before, please use other email.");
		}else{
			$key = F::UniqKey("USER_");
			users::insertInto([
				"u_login"		=> input::post("username"),
				"u_email"		=> input::post("email"),
				"u_password"	=> F::Encrypt(Input::post("password")),
				"u_peer"		=> F::UniqId(32),
				"u_key"			=> $key,
				"u_gender"		=> 0,
				"u_for"			=> 0
			]);
			
			$u = users::getBy(["u_key" => $key]);
			
			if(count($u) > 0){
				$u = $u[0];
				
				$_SESSION["user_login"] = $u->u_login;
				$_SESSION["user_id"] = $u->u_id;
				$_SESSION["user_gender"] = $u->u_gender;
				$_SESSION["user_for"] = $u->u_for;
				$_SESSION["user_peer"] = $u->u_peer;
				$_SESSION["user_key"] = $u->u_key;
				
				header("Location: " . PORTAL);
			}else{
				new Alert("error", "Sorry, your data cannot be saved now.");
			}
		}
	break;
}



