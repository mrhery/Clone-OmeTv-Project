<?php
new Controller([
	"login"
]);
?>
<style>
.video {
	width: 100%; 
	height: 100%;
}

.btn-full-height{
	height: 100%;
}

.h-100{
	height: 100%;
}

.d-hidden{
	display: none;
}

.chat-container {
	border-radius: 5px;
	height: 100px;
	border: 1px solid #565656;
	margin-bottom: 10px;
	overflow-y: auto;
}

<?php
$gender = "Male";
$herefor = "All";
if(!isset($_SESSION["user_login"])){
?>
.hidden-on-session{
	display: none;
}
<?php
}else{
	if($_SESSION["user_gender"] == 1){
		$gender = "Women";
	}
	
	if($_SESSION["user_for"] == 1){
		$herefor = "Men";
	}
	
	if($_SESSION["user_for"] == 2){
		$herefor = "Women";
	}
	
	users::updateBy(["u_id" => $_SESSION["user_id"]], ["u_waiting" => 0, "u_with" => 0]);
}
?>
</style>

<div class="card mt-2">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				FriendBy Click
			</div>
			
			<div class="col-md-6 text-right">
			<?php
				if(isset($_SESSION["user_login"])){
			?>
				<a href="<?= PORTAL ?>logout" class="btn btn-danger btn-sm">
					Logout
				</a>
			<?php
				}
			?>
			</div>
		</div>
	</div>
	
	<div class="card-body">
		<div class="row mb-2">
			<div class="col-md-6">
				<video class="video" id="my-video" muted="true" autoplay="true" poster="<?= PORTAL ?>assets/images/bg.png" />
			</div>
			
			<div class="col-md-6">
				<video class="video" id="client-video" autoplay="true" poster="<?= PORTAL ?>assets/images/bg.png" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
			<?php
				if(isset($_SESION["user_login"])){
			?>
				<div class="chat-container" id="chat-container">
					
				</div>
				<input type="text" class="form-control mb-2" placeholder="Messages" id="message" />
				<button class="btn btn-block btn-sm btn-primary" id="send-message">
					Send Message
				</button>
			<?php
				}
			?>
			</div>
			
			<div class="col-md-6">
				<div class="row h-100">
					<div class="col-3">
						<button class="btn btn-success btn-lg btn-block btn-full-height" id="start-button">
							Start
						</button>
						
						<button class="btn btn-success btn-lg btn-block btn-full-height d-hidden hidden-on-session" style="margin-top: 0;" id="next-button">
							Next
						</button>
					</div>
					
					<div class="col-3">
						<button class="btn btn-danger btn-lg btn-block btn-full-height hidden-on-session" id="stop-button">
							Stop
						</button>
					</div>
					
					<div class="col-3">
						<button class="btn btn-light btn-lg btn-block btn-full-height hidden-on-session" id="gender-button">
							I am <span id="my-gender"><?= $gender ?></span> 
						</button>
					</div>
					
					<div class="col-3">
						<button class="btn btn-light btn-lg btn-block btn-full-height hidden-on-session" id="here-for-button">
							Here for <span id="my-here-for"><?= $herefor ?></span> 
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
if(!isset($_SESSION["user_login"])){
?>
<div class="modal fade" id="login-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Please Login</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Login Here
							</div>
							
							<div class="card-body">
								<form action="" method="POST">
									Username:
									<input type="text" placeholder="Username" class="form-control" name="username" /><br />
									
									Password:
									<input type="password" placeholder="Password" class="form-control" name="password" /><br />
									
									<button class="btn btn-primary">
										Login
									</button>
								
								<?php
									Controller::form("login", [
										"action"	=> "login"
									]);
								?>
								</form>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Register & Login
							</div>
							
							<div class="card-body">
								<form action="" method="POST">
									Email:
									<input type="email" placeholder="Email" class="form-control" name="email" /><br />
									
									Username:
									<input type="text" placeholder="Username" class="form-control" name="username" /><br />
									
									Password:
									<input type="password" placeholder="Password" class="form-control" name="password" /><br />
									
									<button class="btn btn-primary">
										Register & Login
									</button>
									<?php
										Controller::form("login", [
											"action"	=> "register"
										]);
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<?php
}
?>

<script>
var localStream = null;
var peer = null;
var waiting_poll = true;
var remoteCall = null;
var isStop = true;

<?php
if(isset($_SESSION["user_login"])){
?>
stream_chat();

$("#message").on("keyup", function(e){
	if(e.keyCode == 13){
		send_message();
	}
});

$("#send-message").on("click", function(){
	send_message();
});

function send_message(){
	var message = base64_encode($("#message").val());
	
	if(remoteCall != null){
		$.ajax({
			url: PORTAL + "api/chat",
			method: "POST",
			data: {
				action: "send",
				content: message,
				to: remoteCall.peer
			},
			dataType: "text"
		}).done(function(res){
			$("#message").val("");
			$("#message").focus();
		});
	}else{
		alert("You are not connected to anybody.");
	}
}

function stream_chat(){
	setTimeout(function(){
		$.ajax({
			url: PORTAL + "api/chat",
			method: "POST",
			data: {
				action: "stream"
			},
			dataType: "json"
		}).done(function(r){
			if(r.status == "success"){
				$(".chat-container").html("");
				
				r.data.forEach(function(d){
					$(".chat-container").append('\
						<div class="mb-2">\
							<strong>User '+ d.c_from +' said: </strong>\
							'+ base64_decode(d.c_content) +'\
						</div>\
					');
				});
				
				document.getElementById("chat-container").scrollTop = document.getElementById("chat-container").scrollHeight;
				
				
			}else{
				console.log(r.message);
			}
		});
		stream_chat();
	}, 3000);
}

$("#next-button").on("click", function(){
	if(remoteCall != null){
		remoteCall.close();
	}
	
	$("#client-video").prop("srcObject", null);
	
	waiting_call();
});

function call_user(peerid){
	if(peer != null){
		var call = peer.call(peerid, localStream);
		
		call.on("stream", function(rstream){
			remoteCall = call;
			waiting_poll = false;
			
			$("#client-video").prop("srcObject", rstream);
			
			$.ajax({
				url: PORTAL + "api/answer_call",
				method: "POST",
				data:{
					"peerid": call.peer
				},
				dataType: "text"
			}).done(function(res){				
				console.log(res);
			});
		});
		
		call.on("close", function(){
			$("#client-video").prop("srcObject", null);
			
			if(!isStop){
				waiting_poll = true;
				waiting_call();
			}
		});
	}else{
		alert("Cannot call user as your peer connection is not ready.");
	}
}

function waiting_call(){
	// console.log("Waiting call list:");
	
	if(waiting_poll){
		setTimeout(function(){
			// console.log("start polling");
			$.ajax({
				url: PORTAL + "api/waiting",
				method: "POST",
				dataType: "json"
			}).done(function(res){
				// console.log(res);
				
				if(waiting_poll){
					if(res.status == "success"){
						// console.log("Partner found");
						
						waiting_poll = false;
						
						call_user(res.data.peerid);
					}else{
						// console.log("Partner not found");
						waiting_call();
					}
				}else{
					if(remoteCall != null){
						$.ajax({
							url: PORTAL + "api/answer_call",
							method: "POST",
							data:{
								"peerid": remoteCall.peer
							},
							dataType: "text"
						}).done(function(res){				
							// console.log(res);
						});
					}
				}
			});
		}, 5000);
	}
}

$("#gender-button").on("click", function(){
	var current_gender = $("#my-gender").text();
	
	if(current_gender == "Male"){
		current_gender  = "Female";
		$("#my-gender").text("Female");
	}else{
		current_gender  = "Male";
		$("#my-gender").text("Male");
	}
	
	$.ajax({
		url: PORTAL + "api/my-gender",
		method: "POST",
		data:{
			"gender": current_gender
		}
	});
});

$("#here-for-button").on("click", function(){
	var current_here_for = $("#my-here-for").text();
	
	if(current_here_for == "All"){
		current_here_for = "Men";
		$("#my-here-for").text("Men");
	}else if(current_here_for == "Men"){
		current_here_for = "Women";
		$("#my-here-for").text("Women");
	}else{
		current_here_for = "All";
		$("#my-here-for").text("All");
	}
	
	$.ajax({
		url: PORTAL + "api/my-here-for",
		method: "POST",
		data:{
			"here_for": current_here_for
		}
	});
});


$("#stop-button").on("click", function(){
	isStop = true;
	$("#start-button").show();
	$("#next-button").hide();
	
	localStream.getTracks().forEach(function(track) {
		track.stop();
	});
	
	$("#my-video").prop("srcObject", null);
	
	waiting_poll = false;
	
	if(remoteCall != null){
		remoteCall.close();
	}
	
	$.ajax({
		url: PORTAL + "api/stop",
		method: "POST",
		data:{
			"stop": true
		}
	});
});

function start_peer(){
	peer = new Peer("<?= isset($_SESSION["user_peer"]) ? $_SESSION["user_peer"] : "" ?>", {
		host: "offwork.akeatechnology.com",
		port: 9000,
		key: "peerjs",
		config:{
			"iceServers": [
				{urls: "stun:offwork.akeatechnology.com:5349"},
				{
					urls: "turn:offwork.akeatechnology.com:5349", 
					username: "guest", 
					credential: "1234567890" 
				}
			]
		}
	});
	
	peer.on("open", function(){
		console.log("Peer connection is ready.");
		
		if(!isStop){
			waiting_poll = true;
			waiting_call();
		}
		
	});
	
	peer.on("call", function(call){
		call.answer(localStream);
		
		call.on("stream", function(rstream){
			// console.log("terima call");
			waiting_poll = false;
			remoteCall = call;
			
			$("#client-video").prop("srcObject", rstream);
			
			//console.log(call.peer);
			
			$.ajax({
				url: PORTAL + "api/answer_call",
				method: "POST",
				data:{
					"peerid": call.peer
				},
				dataType: "text"
			}).done(function(res){
				// console.log(res);
			});
		});
		
		call.on("close", function(){
			$("#client-video").prop("srcObject", null);
			
			if(!isStop){
				waiting_poll = true;
				waiting_call();
			}
		});
	});
	
	peer.on("error", function(e){
		setTimeout(function(){
			console.log(e);
		}, 3000);
	});
}
<?php
}
?>

$("#start-button").on("click", function(){
	isStop = false;
<?php
	if(isset($_SESSION["user_login"])){
	?>
	navigator.mediaDevices.getUserMedia({video: true, audio: true}).then(function(lStream){
		localStream = lStream;
		
		$("#start-button").hide();
		$("#next-button").show();
		
		$("#my-video").prop("srcObject", localStream);
		
		start_peer();
	});
	<?php
	}else{
	?>
	$("#login-modal").modal("toggle");
	<?php
	}
?>
	
});


</script>


