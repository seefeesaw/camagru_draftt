<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="height=device-height, initial-scale=1.0">
	<title>cAmAgru | Reset</title>
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<div class="top-nav">
		<a href="/"><p>cAmAgru</p></a>
	</div>
	<div>
		<form class="frm" id="reset" action="reset.php" method="POST" >
			<h2><input class="inp" type="text" id="username" name="username" placeholder="Username" onkeyup="checkUserName()" ></h2>
			<input class="allButs" id="resetBut" type="submit" value="Reset" disabled>
			<br>
			<br>
			<br>
			<div class="notice" id="resetNoticeDiv">
				<?php
				include('./config/database.php');
				$login = $_POST['username'];
				if ($login)
				{
					$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
					//Find Username
					$find_user = $conn->query("SELECT USERNAME FROM users");
					$found = false;
					foreach($find_user as $user_row)
					{
						if($user_row['USERNAME'] == $login)
						{
							$found = true;
							$find_act = $conn->query("SELECT ACTIVATED FROM users WHERE USERNAME like '$login'");
							foreach($find_act as $act_row)
							{
								if($act_row['ACTIVATED'] != '0')
								{
									$act_hash = $act_row['ACTIVATED'];
									$find_email = $conn->query("SELECT EMAIL FROM users WHERE USERNAME like '$login'");
									foreach($find_email as $email_row)
									{
										$email = $email_row['EMAIL'];
										$to = $email;
										$subject = "cAmAgru | Reset";
										$message = "We have recieved a request to reset the password for the account assccoated with this e-mail address. Please click the link below to reset your passw	ord:
http://localhost:8080/Camagru/zain/newpw.php?reset=".$act_hash."

If you did not make this request, someone may be trying to access your account.

Kind regards
cAmAgru Team";
										$head = 'From:noreply@camagru' . "\r\n";
										mail($email, $subject, $message, $head);
									}
									echo "Password reset link sent to the E-Mail associated with '$login'";
								}
								else
									echo "Your account has not been activated. Please activate it by clicking the link sent to your email.";
							}
						}
					}
					if ($found == false)
					{
						echo "User not found";
					}
				}
				?>
			</div>
		</form>
	</div>
	<script>
		function checkUserName()
		{
			var unameboxElement = document.getElementById("username");
			var username = unameboxElement.value;
			var resetBut = document.getElementById("resetBut");
			var pattern = new RegExp(/[~`@!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?1234567890]/);
			if (pattern.test(username) || username.length < 1)
			{	
				unameboxElement.style.borderBottom =  "2px #D12E7D solid";
				unameboxElement.style.borderRight = "2px #D12E7D solid";
				resetBut.disabled = true;
				return false;
			}
			else
			{
				unameboxElement.style.borderBottom =  "2px dodgerblue solid";
				unameboxElement.style.borderRight = "2px dodgerblue solid";
				resetBut.disabled = false;
				return true;
			}
		}
	</script>
</body>
</html>