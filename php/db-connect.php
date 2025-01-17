<?php
// https://www.w3schools.com/php/php_mysql_connect.asp
$servername = "localhost";
$username = "root";
$password = "";
$database = "quiz";
$port = 3306;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Location: error.php?error=db');
    die();
}