<?php
       $user = "seefeesaw";
       $password = "seefeesaw1";

      // Create camugru database
      try {
          $con = new PDO ("mysql:host=localhost", $user, $password);
          $con-> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
          $sql = "CREATE DATABASE IF NOT EXISTS camagru";
          $con->exec($sql);
          echo "<h1>Camagru Database created </h1></br>";
          $con = null;  
      }
      catch (PDOException $exception) {
          echo "<h1>PDOexception:</h1></br>$exception</br>";
      }


      //Create users table in Camagru database
      try {
          $con = new PDO ("mysql:host=localhost;dbname=camagru", $user, $password);
          $con-> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
          $sql = "CREATE TABLE IF NOT EXISTS users (
              ID int (32) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              USERNAME VARCHAR (100) NOT NULL,
              EMAIL VARCHAR (100) NOT NULL,
              PASSWORD TEXT NOT NULL,
              ACT_HASH VARCHAR (100) NOT NULL,
              ACTIVATED VARCHAR (32) NOT NULL DEFAULT '0',
              COMMENT_NOTIF BOOLEAN DEFAULT TRUE)";
              $con->exec($sql);
              echo "<h1>Users table created</h1></br>";
              $con = null;
      }
          catch (PDOException $exception) {
            echo "<h1>PDOexception:</h1></br>$exception</br>";
        }

        // create images table
        try {
            $con = new PDO ("mysql:host=localhost;dbname=camagru", $user, $password);
            $con ->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS images (
                ID int (32) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                USER BLOB NOT NULL,
                URL BLOB NOT NULL,
                UNIT_TIMESTAMP int (32) NOT NULL)";
            $con ->exec($sql);
            echo "<h1>Images table created</h1></br>";
            $con = null;
        }
        catch (PDOException $exception) {
            echo "<h1>PDOexception:</h1></br>$exception</br>";
        }


        //create comments table
        try {
            $con = new PDO("mysql:host=localhost;dbname=camagru", $user, $password);
            $con ->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS comments (
                ID int (32) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                USER VARCHAR (32) NOT NULL, 
                TEXT VARCHAR (600) NOT NULL,
                UNIT_TIMESTAMP int (32) NOT NULL)";
            $con ->exec($sql);
            echo "<h1> comments table created</h1></br>";
            $con = null;
        }
        catch (PDOException $exception) {
            echo "<h1>PDOexception:</h1></br>$exception</br>";
        }


        //Create likes table 
        try {
            $con = new PDO ("mysql:host=localhost;dbname=camagru", $user, $password);
            $con ->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS likes (
                ID int (32) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                USER VARCHAR (32) NOT NULL,
                IMG_ID int (32) NOT NULL,
                UNIT_TIMESTAMP int (11) NOT NULL)";
            $con->exec($sql);
            echo "<h1>likes table created </h1></br>";
            $con = null;
        }
        catch (PDOException $exception) {
            echo "<h1>PDOexception:</h1></br>$exception</br>";
        }



?>

<<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
       
        
        <script src="" async defer></script>
    </body>
</html>