<?php
	session_start();
	if(isset($_SESSION['id'])){
		require "connection.php";
		$chat_id = $_GET['chat_id'];
		$uid = $_GET['uid'];
		$id = $_SESSION['id'];
		if($uid == $id){
			$sql = "SELECT * FROM members WHERE (m_rid = $chat_id)";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) == 1){
				$sql_m = "DELETE FROM members WHERE (m_rid = $chat_id)";
				$res_m = mysqli_query($conn, $sql_m);
				$sql_r = "DELETE FROM rooms WHERE (rid = $chat_id)";
				$res_r = mysqli_query($conn, $sql_r);
				header("Location: ../chats.php");
			} else {
				echo "<script>
						alert('You must delete all members before deleting the chatroom!');
						window.location.href='../editRoom.php';
					</script>";
			}
		} else {
			$sql = "SELECT * FROM members WHERE (m_uid = $uid and m_rid = $chat_id)";
			$res = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($res);
			if($row['mstatus'] == 0){
				$sql_m = "UPDATE members SET mstatus = 1 WHERE (m_uid = $uid and m_rid = $chat_id)";
				$res_m = mysqli_query($conn, $sql_m);
				header("Location: ../editRoom.php");
			} else {
				$sql_m = "DELETE FROM members WHERE (m_uid = $uid and m_rid = $chat_id)";
				$res_m = mysqli_query($conn, $sql_m); 
				header("Location: ../editRoom.php");
			}
		}
		

	} else {
		header("Location: ../login.php");
	}

?>