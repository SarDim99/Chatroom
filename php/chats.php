<?php
	session_start();
	if(isset($_SESSION['id'])){
		require("connection.php");
		
		$id = $_SESSION['id'];
		$output = "";
		$sql = "SELECT * FROM members WHERE(m_uid = '$id')";
		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) == 0){
			$output = "No chats";
		} elseif(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				$rid = $row['m_rid'];
				$sql_r = "SELECT rname FROM rooms WHERE(rid = '$rid')";
				$res_r = mysqli_query($conn, $sql_r);
				$row_r = mysqli_fetch_assoc($res_r);
				if($row_r['rname'] === 'General'){
					$sql2 = "SELECT * FROM messages WHERE (ms_rid = $rid) ORDER BY msid DESC LIMIT 1";
					$res2 = mysqli_query($conn, $sql2);
					
					if(mysqli_num_rows($res2) > 0){
						$row2 = mysqli_fetch_assoc($res2);
						$uid = $row2['ms_uid'];
						$sql3 = "SELECT * FROM users WHERE(uid = $uid)";
						$res3 = mysqli_query($conn, $sql3);
						$row3 = mysqli_fetch_assoc($res3);
						$output .= '<a href="chatroom.php?chat_id='.$rid.'">
										<div class="content">
											<div class="details">
												<span>'. $row_r['rname'] .'</span>
												<p>'.$row3['uusername']. ':' .$row2['mstext'] .'</p>
											</div>
										</div>
									</a>';
					} else {
						$output .= '<a href="chatroom.php?chat_id='.$rid.'">
										<div class="content">
											<div class="details">
												<span>'. $row_r['rname'] .'</span>
												<p>Chat empty</p>
											</div>
										</div>
									</a>';
					}
				} elseif($row['mstatus'] == 1) {
					$sql2 = "SELECT * FROM messages WHERE (ms_rid = $rid) ORDER BY msid DESC LIMIT 1";
					$res2 = mysqli_query($conn, $sql2);
					if(mysqli_num_rows($res2) > 0){
						$row2 = mysqli_fetch_assoc($res2);
						$uid = $row2['ms_uid'];
						$sql3 = "SELECT * FROM users WHERE(uid = $uid)";
						$res3 = mysqli_query($conn, $sql3);
						$row3 = mysqli_fetch_assoc($res3);
						$output .= '<a href="chatroom.php?chat_id='.$rid.'">
										<div class="content">
											<div class="details">
												<span>'. $row_r['rname'] .'</span>
												<p>'.$row3['uusername'].':'. $row2['mstext'] .'</p>
											</div>
										</div>
									</a>';
					} else {
						$output .= '<a href="chatroom.php?chat_id='.$rid.'">
										<div class="content">
											<div class="details">
												<span>'. $row_r['rname'] .'</span>
												<p>Chat empty</p>
											</div>
										</div>
									</a>';
					}
				}
			}
		}
		echo $output;
	} else {
		header("../signup.php");
	}
?>