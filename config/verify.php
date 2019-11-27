<?php
include('./database.php');
$user = $_GET['user'];
$hash = $_GET['hash'];
$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
$find_user = $conn->query("SELECT USERNAME FROM users");
foreach($find_user as $user_row)
{
    if($user_row['USERNAME'] == $user)
    {
        $find_hash = $conn->query("SELECT ACT_HASH FROM users WHERE USERNAME like '$user'");
        foreach($find_hash as $hash_row)
        {
            if($hash_row['ACT_HASH'] == $hash)
            {
                $update = $conn->prepare("UPDATE users SET ACTIVATED=:ACTIVATED WHERE USERNAME like '$user'");
                $update->bindParam(":ACTIVATED", hash('md5', $user));
                /*$populate->bindParam(":USERNAME", $login);*/
                $update->execute();
               header("location:localhost:8080/Camagru/zain/index.php");
            }
            
        }
    }
}
?>