<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="createRoom.css">
	<title>Create Room</title>
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
		if (isset($_POST['submit'])){
			$name = $_POST['name'];
			$id = $_SESSION["id"];

			$query = "SELECT * FROM rooms WHERE (rname = '$name' and rowner = '$id')";
			$res = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($res);
			if (mysqli_num_rows($res) > 0){
				echo "<script>
						alert('You have a room with the same name!');
						window.location.href='createRoom.php';
					</script>";
			} else {
				$sql = "INSERT INTO rooms(rname, rowner) VALUES ('$name', '$id')";
				$rec = mysqli_query($conn, $sql);

				$sql_m = "SELECT * FROM rooms WHERE(rname = '$name' and rowner = '$id')";
				$res = mysqli_query($conn, $sql_m);
				$row = mysqli_fetch_assoc($res);

				$rid = $row['rid'];
					
				$rec_m = mysqli_query($conn, "INSERT INTO members(m_uid, m_rid, mstatus) VALUES('$id', '$rid', '1')");
					
				echo "<script>
						alert('Room created successfully!');
						window.location.href='login.php';
					</script>";

				header("Location: chats.php");
			}
		}
	?>

		<div class="container">
			<section class="createRoom form">
				<header>
					<a href="chats.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

					<span>Create Room</span>
				</header>
				<form method="POST" autocomplete="off">
					<div class="field input">
						<input type="text" name="name" placeholder="Rooms name" required>
					</div>

					<div class="field button">
						<input type="submit" name="submit" value="Create">
					</div>
				</form>
			</section>
		</div>
</body>
</html>