<?php
	session_start();
	if(isset($_SESSION['id'])){
		require("connection.php");
		$sender = mysqli_real_escape_string($conn, $_POST['sender']);
		$reciever = mysqli_real_escape_string($conn, $_POST['reciever']);
		$message = mysqli_real_escape_string($conn, $_POST['message']);
		$datetime = date_create()->format('Y-m-d H:i:s');

		if(!empty($message)){
			$sql = "INSERT INTO messages(ms_uid, ms_rid, msdatetime, mstext) VALUES({$sender}, {$reciever},  '{$datetime}','{$message}')";
			$res = mysqli_query($conn, $sql);
		}
	} else {
		header("../signup.php");
	}

	
?>