<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = "";
    unset($_SESSION['loggedin']);
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
    header("location:http://localhost:8080/camagru/");
}
else {
    echo "<h1>Error: Not Logged In. Redirecting...</h1></br>";
    header("location:http://127.0.0.1:8080");
}