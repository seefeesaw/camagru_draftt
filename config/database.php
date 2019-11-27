<?php
$DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
$DB_USER = "seefeesaw";
$DB_PASSWORD = "seefeesaw1";
$DB_OPT = [
    PDO :: ATTR_ERRMODE             => PDO:: ERRMODE_EXCEPTION,
    PDO :: ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
    PDO :: ATTR_EMULATE_PREPARES    => false, 
];
?>
