<?php
    $dsn = 'mysql:host=localhost;dbname=php_mvc';
    $username = 'root';
    try {
        $db = new PDO($dsn, $username);
    }
    catch (PDOException $e){
        $error = "Database Error: ";
        $error .= $e->getMessage();
        include('views/error.php');
    }