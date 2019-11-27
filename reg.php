<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="height=device-height, initial-scale=1.0">
	<title>cAmAgru | Register </title>
	<link href="./main.css" rel="stylesheet">
</head>
<body>
	<div class="top-nav">
		<a href="/"><p>cAmAgru</p></a>
	</div>
	<div>
		<form class="frm" id="signup" action="reg.php" method="POST" >
			<div class="notice">
				<?php
				$login = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$password = hash('md5', $password);
				$act_hash = hash('md5', $login);
				$passPass = false;
				$usernamePass = false;
				if (isset($login) && isset($email) && isset($password) && !empty($login) && !empty($email) && !empty($password))
				{
					$pattern = "/~`@!#$%\^&*+=\-\[\]\';,/{}|:<>\?1234567890/";
					for ($i = 0; $i < iconv_strlen($pattern); $i++)
					{
						//Check password conditions
						if (strpos($password, $pattern[$i]) && iconv_strlen($password) > 5)
							$passPass = true;							
						//Check Username for invaild chars
						if (strpos($username, $pattern[$i]))
							$usernamePass = true;		
					}
					if ($passPass === false)
						echo 'Invalid Password';
					if ($usernamePass)
						echo 'Invalid Username';
					if ($passPass && $usernamePass===false)
					{
						if (filter_var($email, FILTER_VALIDATE_EMAIL))
						{
							$lastChecks = true;
             				//form submitted with correct email format
							include('./config/database.php');
							$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
							//Check if Username already exists
							$find_user = $conn->query("SELECT USERNAME FROM users");
							foreach($find_user as $user_row)
							{
								if ($user_row['USERNAME'] == $login)
								{
									echo "Username already in use";
									$lastChecks = false;
								}
							}
							//Check if email alrady exists
							$find_email = $conn->query("SELECT EMAIL FROM users");
							foreach($find_email as $email_row)
							{
								if ($email_row['EMAIL'] == $email)
								{
									if ($lastChecks == false)
										echo "<br>E-Mail already in use";
									else
									{
										echo "E-Mail already in use";
										$lastChecks = false;
									}
								}
							}
							if ($lastChecks)
							{
								//All checks done, add user to DB
							$populate = $conn->prepare("INSERT INTO users (USERNAME, EMAIL, PASSWORD, ACT_HASH)
								VALUES(:USERNAME, :EMAIL, :PASSWORD, :ACT_HASH)");
							$populate->bindParam(":USERNAME", $login);
							$populate->bindParam(":EMAIL", $email);
							$populate->bindParam(":PASSWORD", $password);
							$populate->bindParam(":ACT_HASH", $act_hash);
							$populate->execute(); 


							$to = $email;
							$subject = "cAmAgru | Activation";
							$message = "Thank you for registering with cAmAgru.
							You can log in using the following credentals after verification:
							-------------------
							Username :".$login."
							Password :".$password."
							-------------------
							Please verify your account by clicking the link below:
							http://localhost:8080/Camagru/zain/config/verify.php?user=$login&hash=$act_hash
							
							Kind regards
							cAmAgru Team";
							$head = 'From:noreply@cAmAgru' . "\r\n";
							mail($email, $subject, $message, $head);
							echo "Please verify your account by clicking the link sent to $email";
							die();
							}
						}
						else
							echo "Invalid E-Mail";
					}
				}
				?>
			</div>
			<h2><input class="inp" type="text" id="username" name="username" placeholder="Username" onkeyup="checkUserName()"></h2>
			<h2><input class="inp" type="text" id="email" name="email" placeholder="E-Mail" onkeyup="checkEmail()"></h2>
			<h2><input class="inp" type="password" id="password" name="password" placeholder="Password" onkeyup="checkPassword(true)"></h2>
			<h2><input class="inp" type="password" id="password_c" name="password_c" placeholder="Confirm Password" onkeyup="confAll()"></h2>
			<div id="pass_checker">
				<div class="figure" id="length">Length: 6 more</div>    
				<div class="figure" id="sc">Special Character/Number</div>
				<div class="figure" id="conf">Confirm Password</div>
			</div>
            <input class="allButs" id="register" type="submit" value="Register" disabled>
		</form>
	</div>
	<div class="home">
		<a href="./index.php">Already Registered?</a>
	</div>
	<script>
		function checkUserName()
		{
			var unameboxElement = document.getElementById("username");
			var username = unameboxElement.value;
			var pattern = new RegExp(/[~`@!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?1234567890]/);
			if (pattern.test(username) || username.length < 1)
			{	
				unameboxElement.style.borderBottom =  "2px #D12E7D solid";
				unameboxElement.style.borderRight = "2px #D12E7D solid";
				return false;
			}
			else
			{
				unameboxElement.style.borderBottom =  "2px dodgerblue solid";
				unameboxElement.style.borderRight = "2px dodgerblue solid";
				return true;
			}
		}

		function checkEmail()
		{
			var emailboxElement = document.getElementById("email");
			var email = emailboxElement.value;
			var pattern = new RegExp(/.+@.+/);
			if (pattern.test(email) && email.length > 5)
			{
				emailboxElement.style.borderBottom =  "2px dodgerblue solid";
				emailboxElement.style.borderRight = "2px dodgerblue solid";
				return true;

			}
			else
			{
				emailboxElement.style.borderBottom =  "2px #D12E7D solid";
				emailboxElement.style.borderRight = "2px #D12E7D solid";
				return false;
			}
		}

		function checkPassword(x)
		{
			var passElement = document.getElementById('password');
			var lenCheckElement = document.getElementById('length');
			var scCheckElement = document.getElementById('sc');
			var pass = passElement.value;
			var plen = pass.length;
			var more = 6-plen;
			var specChar = false;
			var confPass = false;
			var pattern = new RegExp(/[~`@!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?1234567890]/);
			if (x == true)
			{
				lenCheckElement.style.visibility='visible';
				scCheckElement.style.visibility='visible';
			}
			if (more < 0)
				more = 0;
			if (more == 0)
			{
				lenCheckElement.style.color = "dodgerblue";
				passElement.style.borderBottom =  "2px dodgerblue solid";
				passElement.style.borderRight = "2px dodgerblue solid";
			}
			else
			{
				lenCheckElement.style.color = "#D12E7D";
				passElement.style.borderBottom =  "2px #D12E7D solid";
				passElement.style.borderRight = "2px #D12E7D solid";
			}
			lenCheckElement.innerHTML = 'Length: '+more+' more';
			if (pattern.test(pass))
				specChar = true;
			if (specChar)
			{
				scCheckElement.style.color = "dodgerblue";
				passElement.style.borderBottom =  "2px dodgerblue solid";
				passElement.style.borderRight = "2px dodgerblue solid";
			}
			else
			{
				scCheckElement.style.color = "#D12E7D";
				passElement.style.borderBottom =  "2px #D12E7D solid";
				passElement.style.borderRight = "2px #D12E7D solid";
			}
			if (more == 0 && specChar)
				return true;
			else
				return false;
		}

		function confAll()
		{
			var passElement = document.getElementById('password');
			var passcElement = document.getElementById('password_c');
			var lenCheckElement = document.getElementById('length');
			var scCheckElement = document.getElementById('sc');
			var confElement = document.getElementById('conf');
			var regButElement = document.getElementById('register');
			var pass = passElement.value;
			var passc = passcElement.value;
			lenCheckElement.style.visibility='hidden';
			scCheckElement.style.visibility='hidden';
			confElement.style.visibility='visible';
			var a = checkPassword(false);
			var b = checkUserName();
			var c = checkEmail();
			if (pass == passc && a && b && c)
			{
				regButElement.disabled=false;
				confElement.style.color = "dodgerblue";
				passcElement.style.borderBottom =  "2px dodgerblue solid";
				passcElement.style.borderRight = "2px dodgerblue solid";
			}
			else
			{
				regButElement.disabled=true;
				confElement.style.color = "#D12E7D";
				passcElement.style.borderBottom =  "2px #D12E7D solid";
				passcElement.style.borderRight = "2px #D12E7D solid";
			}
		}
	</script>
</body>
</html>
