<?php
//A journey start with a step

$page = new Page();

$page->addTopTag('
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
	
	<script>
		let PORTAL = "'. PORTAL .'";
	</script>
');

$page->setMainMenu("widgets/header.php");
$page->setFooter("widgets/footer.php");
switch(url::get(0)){
	case "index":
		$page->loadPage("pages/index");
		$page->title = "Welcome to RanCall (Random Online Call)";
		$page->render();
	break;
	
	case "api":
		if(isset($_SESSION["user_login"])){
			switch(url::get(1)){
				case "chat":
					switch(input::post("action")){
						case "send":
							$u = users::getBy(["u_peer" => Input::post("to"), "u_with" => $_SESSION["user_id"]]);
							
							if(count($u)){
								$u = $u[0];
								
								chats::insertInto([
									"c_content"	=> input::post("content"),
									"c_from"	=> $_SESSION["user_id"],
									"c_to"		=> $u->u_id,
									"c_time"	=> F::GetTime()
								]);
							}else{
								die(json_encode([
									"status"	=> "error",
									"message"	=> "User not found or not connected."
								]));
							}
						break;
						
						case "stream":
							$chats = chats::list([
								"where" => "c_from = " . $_SESSION["user_id"] . " OR c_to = " . $_SESSION["user_id"],
								"order"	=> "c_id ASC"
							]);
							
							$data = [];
							
							foreach($chats as $c){
								$u = users::getBy(["u_id" => $c->c_from]);
								
								if(count($u)){
									$c->c_from = $u[0]->u_login;
								}
								
								$ux = users::getBy(["u_id" => $c->c_to]);
								
								if(count($ux)){
									$c->c_to = $ux[0]->u_login;
								}
								
								$data[] = $c;
							}
							
							die(json_encode([
								"status"	=> "success",
								"message"	=> "List of your chat",
								"data"		=> $data
							]));
						break;
					}
				break;
				
				case "my-gender":
					$gender = Input::post("gender");
					
					if($gender == "Male"){
						$gender = 0;
					}elseif($gender == "Female"){
						$gender = 1;
					}else{
						$gender = 0;
					}
					
					$_SESSION["user_gender"] = $gender;
					
					users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_gender" => $gender]);
				break;
				
				case "my-here-for":
					$herefor = Input::post("here_for");
					
					if($herefor == "All"){
						$herefor = 0;
					}elseif($herefor == "Men"){
						$herefor = 1;
					}elseif($herefor == "Women"){
						$herefor = 2;
					}else{
						$herefor = 0;
					}
					
					$_SESSION["user_for"] = $herefor;
					
					users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_for" => $herefor]);
				break;
				
				case "stop":					
					users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_waiting" => 0]);
				break;
				
				case "waiting":
					users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_waiting" => 1, "u_with" => 0]);
					
					$sql = "SELECT * FROM users WHERE u_id <> ? AND u_waiting = 1 ";
					$data = [$_SESSION["user_id"]];
					
					if($_SESSION["user_for"] != 0){
						$data[] =  $_SESSION["user_for"];
						$data[] =  $_SESSION["user_gender"];
						$sql .= " AND u_gender = ? AND (u_for = ? OR u_for = 0) ";
					}
					
					$sql .= " ORDER BY RAND() LIMIT 1";
				
					$q = DB::conn()->query($sql, $data)->results();
					
					if(count($q) > 0){
						$q = $q[0];
						
						die(json_encode([
							"status"	=> "success",
							"message"	=> "Your partner has been found.",
							"data"		=> [
								"peerid"	=> $q->u_peer,
								"name"		=> $q->u_login,
								"gender"	=> $q->u_gender ? "Women" : "Men"
							]
						]));
					}else{
						die(json_encode([
							"status"	=> "error",
							"message"	=> "No user online at this time. You can try to change you seek for and gender to meet more people."
						]));
					}
				break;
				
				case "answer_call":
					$u = users::getBy(["u_peer" => Input::post("peerid")]);
					
					if(count($u) > 0){
						$u = $u[0];
						
						users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_waiting" => 0, "u_with" => $u->u_id]);
					}
				break;
			}
		}else{
			die(json_encode([
				"status"	=> "error",
				"message"	=> "You are not allowed to make a request to API endpoint."
			]));
		}
	break;
	
	case "logout":
		session_destroy();
		
		header("Location: " . PORTAL);
	break;
}


