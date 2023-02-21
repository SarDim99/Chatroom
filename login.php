<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		require "connection.php";
		session_start();
		if (isset($_POST["username"])){
			$username = stripslashes($_POST['username']);
			$username = mysqli_real_escape_string($conn, $username);
			$pass = stripslashes($_POST['password']);
			$pass = mysqli_real_escape_string($conn, $pass);
			
			$query = "SELECT * FROM users WHERE (uusername = '$username' and upass = '$pass')";
			$res = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($res);
			if (mysqli_num_rows($res) == 1){
				$_SESSION['username'] = $username;
				$_SESSION['name'] = $row['uname'];
				$_SESSION['id'] = $row['uid'];
				header("Location: chats.php");
				die(); 
			} else {
				echo "<script>
					alert('Username or Password inncorect! Please try again');
					window.location.href='login.php';
					</script>";
			}
		} else {
	?>
	<div class="container">
		<section class="form login">
			<header>Sign In</header>
			<form method="POST" autocomplete="off">
				<div class="field input">
					<input type="text" name="username" placeholder="Username" required>
				</div>
				<div class="field input">
					<input type="password" name="password" placeholder="Password" required>
				</div>
				<div class="field button">
					<input type="submit" name="submit" value="Sign In">
				</div>
			</form>
			<div class="link">Not yet signed up? <a href="signup.php">Register now</a></div>
		</section>
	</div>
<?php } ?>
</body>
</html>