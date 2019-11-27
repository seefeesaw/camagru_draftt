<!-- <?php
session_start();
?> -->
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="height=device-height, initial-scale=1.0">
	<title>cAmAgru | Login</title>
	<link href="./main.css" rel="stylesheet">
</head>
<body>
<div id="top-nav">
		<div id="title" class="top-nav"><a href="/">cAmAgru</a></div>
	</div>
	<div>
		<form class="frm" id="signin" action="index.php" method="POST" >
			<div class="notice">
				<?php
				session_start();
				include('./config/database.php');
				$login = $_POST['username'];
				$password = $_POST['password'];
				$pass = hash("md5", $password);
				if ($login && $password)
				{
					$found = false;
					$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
					//Find Username
					$find_user = $conn->query("SELECT USERNAME FROM users");
					foreach($find_user as $user_row)
					{
						if ($user_row['USERNAME'] == $login)
						{
							$found = true;
							$db_pass = $conn->query("SELECT PASSWORD FROM users WHERE USERNAME LIKE '$login'");
							foreach ($db_pass as $dbp)
							{
								if ($dbp['PASSWORD'] == $pass)
								{
									$_SESSION['loggedin'] = true;
									$_SESSION['username'] = $login;
									header("location: http://localhost:8080/camagru/zain/camagru.php");
								}
								else
								{
									echo "Wrong password<br>";
								}
							}
						}
					}
					if ($found == false)
					{
						echo "User not found";
					}
				}
				else
				{
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
					header("location:localhost:8080/camagru/camagru.php");
				}
				?>
			</div>
			<h2><input class="inp" type="text" name="username" placeholder="Username"></h2>
			<h2><input class="inp" type="password" name="password" placeholder="Password"></h2>
			<input class="allButs" id="login" type="submit" value="Login">
			<ul>

				<div class="allButs" id="ulbuts1">
					<a href="./reg.php">
						<li class="button">Register</li>
					</a>
				</div>

				<div class="allButs" id="ulbuts2">
					<a href="./reset.php">
						<li class="button">Reset Password</li>
					</a>
				</div>
                
			</ul>
		</form>
	</div>
</body>
</html>