<?php
$host = "localhost";
$dbname = "rewardzone";
$user = "root";
$pass = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} 
catch (PDOException $e) {
    exit("Database connection failed.");
}
?>
