<?php
	require("connection.php");
	$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
	$output = "";

	$sql = "SELECT * FROM rooms WHERE rname LIKE '%{$searchTerm}%'";
	$res = mysqli_query($conn, $sql);
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$output .= '<a href="chatroom.php?chat_id='. $row['rid'] .'">
							<div class="content">
								<div class="details">
									<span>'. $row['rname'] .'</span>
								</div>
							</div>
						</a>';
		}
	} else {
		$output .= "No chat found!";
	}
	echo $output;
?>