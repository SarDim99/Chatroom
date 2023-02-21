<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<?php
		require ("connection.php");

		if (isset($_POST["submit"])){
			$username = stripslashes($_POST['username']);
			$username = mysqli_real_escape_string($conn, $username);
			$name = stripslashes($_POST['fname']);
			$name = mysqli_real_escape_string($conn, $name);
			$surname = stripslashes($_POST['lname']);
			$surname = mysqli_real_escape_string($conn, $surname);
			$email = stripslashes($_POST['email']);
			$email = mysqli_real_escape_string($conn, $email);
			$pass = stripslashes($_POST['password']);
			$pass = mysqli_real_escape_string($conn, $pass);


			$uppercase = preg_match('@[A-Z]@', $pass);
			$lowercase = preg_match('@[a-z]@', $pass);
			$number    = preg_match('@[0-9]@', $pass);
			$specialChars = preg_match('@[^\w]@', $pass);

			//Check password
			if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
				echo "<script>
					alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
					window.location.href='signup.php';
					</script>";
				die();
			}
			$sql_u = "SELECT * FROM users WHERE (uusername = '$username')";
			$res_u = mysqli_query($conn, $sql_u);

			$sql_e = "SELECT * FROM users WHERE (uemail = '$email')";
			$res_e = mysqli_query($conn, $sql_e);
			if (mysqli_num_rows($res_u) > 0){
				echo "<script>
					alert('Username already exists!');
					window.location.href='signup.php';
					</script>";
			} elseif (mysqli_num_rows($res_e) > 0){
				echo "<script>
					alert('Email already exists!');
					window.location.href='signup.php';
					</script>";
			} else {
				$sql = "INSERT INTO users(uusername, uname, usurname, uemail, upass) VALUES ('$username', '$name', '$surname', '$email', '$pass')";
				$rec = mysqli_query($conn, $sql);
				
				$sql_m = "SELECT * FROM users WHERE(uusername = '$username')";
				$res = mysqli_query($conn, $sql_m);
				$row = mysqli_fetch_assoc($res);

				$id = $row['uid'];

				$rec_m = mysqli_query($conn, "INSERT INTO members(m_uid, m_rid, mstatus) VALUES('$id', '1', '1')"); 

				header("Location: login.php");
			}
		} else {
	?>
	<div class="container">
		<section class="form signup">
			<header>Sign Up</header>
			<form method="POST" autocomplete="off">
				<div class="name">
					<div class="field input">
						<input type="text" name="fname" placeholder="First Name">
					</div>
					<div class="field input">
						<input type="text" name="lname" placeholder="Last Name">
					</div>
				</div>
				<div class="field input">
					<input type="text" name="username" placeholder="Username" required>
				</div>
				<div class="field input">
					<input type="email" name="email" placeholder="Email" required>
				</div>
				<div class="field input">
					<input type="password" name="password" placeholder="Password" required>
				</div>
				<div class="field button">
					<input type="submit" name="submit" value="Sign Up">
				</div>
			</form>
			<div class="link">Already signed up? <a href="login.php">Login now</a></div>
		</section>
	</div>
	<?php } ?>
</body>
</html>