<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    var_dump($_POST);
    $img = $_POST['image'];
    echo $img;
    $impose = $_POST['impose'];
    $img = str_replace('data:image/png;base64,','',$img);
    //$img = str_replace(' ','+', $img);
    $data = base64_decode($img);

    if (!file_exists('../gallary/')) {
        mkdir('gallary/', 0777, true);
	}
	echo "are we geting in here";
	$upload_dir = "../gallary/";
	
	// $img = $_POST['lolo'];
    //  $img = str_replace('data:image/png;base64,', '', $img);
    // // $img = str_replace(' ', '+', $img);
    // $data = base64_decode($img);
    $name = mktime();
   	$file = $upload_dir . $name . ".png";
	file_put_contents($file, $data);
	echo $img;
}
else {
    echo "<h1>Test</h1></br>";
    hearder ("location:http://localhost:8080");
}
