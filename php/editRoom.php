<?php
	session_start();
	if(isset($_SESSION['id'])){
		require("connection.php");
		
		$id = $_SESSION['id'];
		$output = "";
		$sql = "SELECT m_rid FROM members WHERE(m_uid = '$id')";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		$rid = $row['m_rid'];
		
		$sql2 = "SELECT m_uid FROM members WHERE (m_rid = $rid)";
		$res2 = mysqli_query($conn, $sql2);
		if(mysqli_num_rows($res2) > 0){
			while($row2 = mysqli_fetch_assoc($res2)){
				$sql3 = "SELECT uusername from users where(uid = $row['m_uid'])";
				$res3 = mysqli_query($conn, $sql3);
				$row3 = mysqli_fetch_assoc($res3);
				$output .= '<a href="#">
									<div class="content">
										<div class="details">
											<span>'. $row3['uusername'] .'</span>
											<p>This is test message</p>
										</div>
									</div>
								</a>';

			}
		}
	} else {
		header("../signup.php");
	}
?>