<?php
	session_start();
	if(isset($_SESSION['id'])){
		require("connection.php");
		$id = $_SESSION['id'];
		$rid = $_SESSION['chat_id'];
		
		$sql = "DELETE FROM members WHERE (m_uid = $id and m_rid = $rid)";
		$res = mysqli_query($conn, $sql);

		header("Location: ../chats.php");
	} else {
		header("Location: ../login.php");
	}
?>