<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chat Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		session_start();
		if(!isset($_SESSION['id'])){
			header("Location: login.php");
		}
		require "connection.php";
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM users WHERE (uid = '$id')";
		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
		} else {
			header("Location: signup.php");
			die();
		}
	?>
	<div class="container">
		<section class="chats">
			<header>
				<div class="content">
					<div class="details">
						<span>Available Chatrooms</span>
					</div>
				</div>
				<a href="chats.php" class="logout">Cancel</a>
			</header>
			<div class="chat-list">
				<?php
					$sql2 = "SELECT * FROM rooms WHERE(rid <> '1')";
					$res2 = mysqli_query($conn, $sql2);

					if(mysqli_num_rows($res2) > 0){
						while($row2 = mysqli_fetch_assoc($res2)){
							$rid = $row2['rid'];
							$sql_r = "SELECT * FROM members WHERE(m_rid = '$rid')";
							$res_r = mysqli_query($conn, $sql_r);
							$row_r = mysqli_fetch_assoc($res_r);
							
							if($row_r['m_uid'] != $id ){
								echo '<a href="php/chat-register.php?rid='. $rid .'" class="room-register" style="cursor: default; pointer-events: none;">
											<div class="content">
												<div class="details">
													<span>'. $row2['rname'] .'</span>
												</div>
											</div>
											<button name ="button" value="'. $rid .'" class="plus"><i class="fas fa-plus"></i></button>

										</a>';
							}
						}
					} else {
						echo '<a href="#" class="room-register" style="cursor: default; pointer-events: none;">
									<div class="content">
										<div class="details">
											<span>You are registered in all available chatrooms!</span>
										</div>
									</div>
								</a>';
					}
				?>
			</div>
		</section>
	</div>
</body>
</html>