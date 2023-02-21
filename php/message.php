<?php
	session_start();
	if(isset($_SESSION['id'])){
		require("connection.php");
		$id = $_SESSION['id'];
		$username = $_SESSION['username'];
		$sender = mysqli_real_escape_string($conn, $_POST['sender']);
		$reciever = mysqli_real_escape_string($conn, $_POST['reciever']);
		$output = "";

		$sql = "SELECT * FROM messages WHERE (ms_rid = $reciever)";


		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				if($row['ms_uid'] === $id){
					$output .= '<div class="chat outgoing">
									<div class="details">
										<p>'. $row['mstext'] .'</p>
									</div>
									<p id="time">'. $username.' '.$row['msdatetime'] .'</p>
								</div>
								';
				} else {
					$sql_u = "SELECT * FROM users WHERE(uid = {$row['ms_uid']})";
					$res_u = mysqli_query($conn, $sql_u);
					$row_u = mysqli_fetch_assoc($res_u);
					$letter = substr($row_u['uusername'], 0,1);
					$output .= '<div class="chat incoming">
									<p class="name">'. $letter .'</p>
									<div class="details">
										<p>'. $row['mstext'] .'</p>
									</div>

								</div>
								<p id="time">'. $row_u['uusername'].' ' .$row['msdatetime'] .'</p>';
				}
			}
			echo $output;
		}

	} else {
		header("../signup.php");
	}
?>