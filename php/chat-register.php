<?php
	session_start();
	if(isset($_SESSION['id'])){
		require ("connection.php");
		$rid = $_GET['rid'];
		$id = $_SESSION['id'];

		$sql = "INSERT INTO members (m_uid, m_rid, mstatus) VALUES ($id, $rid, '0')";
		$res = mysqli_query($conn, $sql);
		header("Location: ../chats.php");
	} else {
		header("Location: ../login.php");
	}
?>