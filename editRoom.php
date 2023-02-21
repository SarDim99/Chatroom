<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Room</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION['id'])){
			require "connection.php";
			$id = $_SESSION['id'];
			$chat_id = $_SESSION['chat_id'];
			$sql = "SELECT * FROM rooms WHERE (rid = $chat_id)";
			$res = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($res); 
		} else {
			header("Location: login.php");
		}
	?>
	<div class="container">
		<section class="chats">
			<header>
				<div class="content">
					<div class="details">
						<?php echo '<a href="chatroom.php?chat_id='. $chat_id .'" class="back-icon"><i class="fas fa-arrow-left"></i></a>' ?>
						<span><?php echo $row['rname'] ?></span>
					</div>
				</div>
			</header>

			<div class="chat-list">
				<?php
					$sql_m = "SELECT * FROM members WHERE (m_rid = $chat_id)";
					$res_m = mysqli_query($conn, $sql_m);
					if(mysqli_num_rows($res_m) > 0){
						while($row_m = mysqli_fetch_assoc($res_m)){
							$uid = $row_m['m_uid'];
							$sql_u = "SELECT * FROM users WHERE(uid = $uid)";
							$res_u = mysqli_query($conn, $sql_u);
							$row_u = mysqli_fetch_assoc($res_u);
							if($row_u['uid'] == $id){
								
								echo '<a href="php/delete-user.php?chat_id='. $chat_id .'&amp;uid='. $uid .'">
										<div class="content">
											<div class="details">
												<span>'. $row_u['uusername'] .'</span>
												<p>Owner</p>
											</div>
										</div>
									</a>';
							} elseif($row_m['mstatus'] == '1') {
								
								echo '<a href="php/delete-user.php?chat_id='. $chat_id .'&amp;uid='. $uid .'">
										<div class="content">
											<div class="details">
												<span>'. $row_u['uusername'] .'</span>
												<p>Member</p>
											</div>
										</div>
									</a>';
							} else {
								
								echo '<a href="php/delete-user.php?chat_id='. $chat_id .'&amp;uid='. $uid .'">
										<div class="content">
											<div class="details">
												<span>'. $row_u['uusername'] .'</span>
												<p>Pendind</p>
											</div>
										</div>
									</a>';
							}
						}
					}

				?>
			</div>
		</section>
	</div>
</body>
</html>