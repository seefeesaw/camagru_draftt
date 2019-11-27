<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="height=device-height, initial-scale=1.0">
	<title>cAmAgru | New Password</title>
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<div class="top-nav">
		<a href="/"><p>cAmAgru</p></a>
	</div>
	<div>
		<form class="frm" id="newpw" action="newpw.php" method="POST">
			<h2><input class="inp" type="password" id="password" name="password" placeholder="Password" onkeyup="checkPassword(true)"></h2>
			<h2><input class="inp" type="password" id="password_c" name="password_c" placeholder="Confirm Password" onkeyup="confAll()"></h2>
			<input class="allButs" id="resetBut" type="submit" value="Reset" disabled>
			<br>
			<br>
			<div id="pass_checker">
				<div class="figure" id="length">Length: 6 more</div>    
				<div class="figure" id="sc">Special Character/Number</div>
				<div class="figure" id="conf">Confirm Password</div>
			</div>
			<div class="notice" id="resetNoticeDiv">
				<?php
				session_start();
				include('./config/database.php');
				$get_hash = $_GET['reset'];
				$password = $_POST['password'];
				if (isset($get_hash) && !empty($get_hash))
					$_SESSION['resethash'] = $get_hash;
				else if (isset($password) && !empty($password))
				{
					$resethash = $_SESSION['resethash'];
					$_SESSION['resethash'] = "";
					unset($_SESSION['resethash']);
					$pass = hash("root", $password);
					$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
					$pattern = "/~`@!#$%\^&*+=\-\[\]\';,/{}|:<>\?1234567890/";
					//Check password conditions
					for ($i = 0; $i < iconv_strlen($pattern); $i++)
					{
						if (strpos($password, $pattern[$i]) && iconv_strlen($password) > 5)
							$passPass = true;									
					}
					if ($passPass === false)
						echo 'Invalid Password';
					else
					{
						$update = $conn->prepare("UPDATE users SET PASSWORD=:PASSWORD WHERE ACTIVATED like '$resethash'");
						$update->bindParam(":PASSWORD", $password);
						$update->execute();
						echo "Password Succesfully Updated";
						header("location:http://localhost:8080/Camagru/zain/index.php");
					}
				}
				?>
			</div>
		</form>
	</div>
	<script>
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
			var resButElement = document.getElementById('resetBut');
			var pass = passElement.value;
			var passc = passcElement.value;
			lenCheckElement.style.visibility='hidden';
			scCheckElement.style.visibility='hidden';
			confElement.style.visibility='visible';
			var a = checkPassword(false);
			if (pass == passc && a == true)
			{
				resButElement.disabled=false;
				confElement.style.color = "dodgerblue";
				passcElement.style.borderBottom =  "2px dodgerblue solid";
				passcElement.style.borderRight = "2px dodgerblue solid";
			}
			else
			{
				resButElement.disabled=true;
				confElement.style.color = "#D12E7D";
				passcElement.style.borderBottom =  "2px #D12E7D solid";
				passcElement.style.borderRight = "2px #D12E7D solid";
			}
		}
	</script>
</body>
</html>