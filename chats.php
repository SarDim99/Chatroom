<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chat List</title>
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
			header("Location: login.php");
			die();
		}
	?>
	<div class="container">
		<section class="chats">
			<header>
				<div class="content">
					<div class="details">
						<span><a href="editProfile.php"><?php echo $row['uname'] . " " . $row['usurname']; ?></a></span>
					</div>
				</div>
				<a href="createRoom.php" class="logout">Create Room</a>
				<a href="chat-register.php" class="logout"><i class="fa fa-plus"></i></a>
				<a href="logout.php" class="logout">Logout</a>
			</header>
			<div class="search">
				<span class="tect">Select a chat to enter</span>
				<input type="text" name="" placeholder="Search...">
				<button><i class="fas fa-search"></i></button>
			</div>

			<div class="chat-list">
				
			</div>
		</section>
	</div>

	<script type="text/javascript" src="chats.js"></script>
</body>
</html>