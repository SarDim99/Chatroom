<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Room</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		require("connection.php");
		session_start();
		if(!isset($_SESSION['id'])){
			header("Location: login.php");
		}
		$chat_id = mysqli_real_escape_string($conn, $_GET['chat_id']);
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM rooms WHERE(rid = {$chat_id})";
		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
			$_SESSION['chat_id'] = $chat_id;
		}		
	?>
	<div class="container">
		<section class="chat-area">
			<header>
				<div class="content">
					<a href="chats.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
						
					<div class="details">
						<span><?php echo $row['rname'];  ?></span>
					</div>
				</div>
				<?php
					if($row['rowner'] == $id){
						echo'<a href="editRoom.php" class="logout">Edit Room</a>';
					} else {
						if($row['rid'] != '1'){
							echo'<a href="php/delete.php" class="logout">Exit Room</a>';
						}
					}
				?>
				
			</header>
			<div class="chat-box">
				
			</div>
			<form class="typing-area" action="#" autocomplete="off">
				<input type="text" name="reciever" value="<?php echo $chat_id ?>" hidden>
				<input type="text" name="sender" value="<?php echo $id ?>" hidden>
				<input type="text" name="message" class="screen" placeholder="Type a message...">
				<button><i class="fab fa-telegram-plane"></i></button>
			</form>
		</section>
	</div>

	<script type="text/javascript" src="chatroom.js"></script>
</body>
</html>