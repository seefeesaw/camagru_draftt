<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    $img = $_POST['img'];
    $impose = $_POST['impose'];
    $img = str_replace('data:image/png;base64,','',$img);
    $img = str_replace(' ','+', $img);
    $data = base64_decode($img);
}
else {
    echo "<h1>Test</h1></br>";
    hearder ("location:http://localhost:8080");
}