<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		session_start();
		if(!isset($_SESSION['id'])){
			header('Location: login.php');
		}
		require("connection.php");
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM users WHERE (uid = $id)";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		if(isset($_POST['submit'])){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$username = $_POST['username'];
			$oldPass = $_POST['oldPassword'];
			$newPass = $_POST['newPassword'];
			if($oldPass == $row['upass']){
				if($fname != ""){
					$sql_u = "UPDATE users SET uname = '$fname' WHERE (uid = $id)";
					$res_u = mysqli_query($conn, $sql_u);
				}
				if($lname != ""){
					$sql_u = "UPDATE users SET usurname = '$lname' WHERE (uid = $id)";
					$res_u = mysqli_query($conn, $sql_u);
				}
				if($username != ""){
					$sql_u = "UPDATE users SET uusername = '$username' WHERE (uid = $id)";
					$res_u = mysqli_query($conn, $sql_u);
				}
				if($newPass != ""){
					$uppercase = preg_match('@[A-Z]@', $newPass);
					$lowercase = preg_match('@[a-z]@', $newPass);
					$number    = preg_match('@[0-9]@', $newPass);
					$specialChars = preg_match('@[^\w]@', $newPass);

					//Check password
					if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPass) < 8) {
						echo "<script>
							alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
							window.location.href='signup.php';
							</script>";
						die();
					}
					$sql_u = "UPDATE users SET upass = '$newPass' WHERE (uid = $id)";
					$res_u = mysqli_query($conn, $sql_u);
				}
				echo "<script>
						alert('Changes saved!');
						window.location.href='chats.php';
					</script>";
			} else {
				echo "<script>
						alert('Wrong password, please try again!');
						window.location.href='editProfile.php';
					</script>";
			}	
		}
	?>
	<div class="container">
		<section class="form signup">
			<header>Edit Profile</header>
			<form method="POST" autocomplete="off">
				<div class="name">
					<div class="field input">
						<input type="text" name="fname" placeholder="<?php echo $row['uname'] ?>">
					</div>
					<div class="field input">
						<input type="text" name="lname" placeholder="<?php echo $row['usurname'] ?>">
					</div>
				</div>
				<div class="field input">
					<input type="text" name="username" placeholder="<?php echo $row['uusername'] ?>">
				</div>
				<div class="field input">
					<input type="password" name="oldPassword" placeholder="Old Password" required>
				</div>
				<div class="field input">
					<input type="password" name="newPassword" placeholder="New Password">
				</div>
				<div class="field button">
					<input type="submit" name="submit" value="Save">
				</div>
				<div class="field button">
					<input type="button" name="cancel" value="Cancel" onclick="location.href='chats.php'">
				</div>
			</form>
			
		</section>
	</div>
</body>
</html>