<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "djas_web_wizard";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
