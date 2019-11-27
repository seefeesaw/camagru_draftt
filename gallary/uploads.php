<?php
session_start();
var_dump($_SESSION);
echo strlen($_POST["image"]);
$msg = "";

if (isset($_SESSION['loggedin']) == true || $_SESSION['loggedin'] == true)
{
	include('../config/database.php');
	$found = false;
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
	$user = $_SESSION['username'];
	{
        $populate = $conn->prepare("INSERT INTO `images` (`user`, `url`) VALUES(:users, :urll)");
        $populate->bindParam(":users",$user);
        $populate->bindParam(":urll", $_POST["image"]);
        $populate->execute();
	}

	$target = "images/".basename($_FILES['image']['name']);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
		$msg = "image upload successfully";
		}else{
		$msg = "There was a problem uploading image";
		}

}
?>
