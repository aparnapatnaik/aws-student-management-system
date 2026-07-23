<?php
$host = "database-1.cvgswa0k4q55.eu-north-1.rds.amazonaws.com";
$db   = "school";
$user = "admin";
$pass = "1234apap";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
    die("DB Connection Failed: " . $e->getMessage());
}
?>

