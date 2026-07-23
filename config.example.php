<?php
$host = "database-1.cvgswa0k4q55.eu-north-1.rds.amazonaws.com";
$dbname = "school";
$user = "admin";
$pass = "1234apap";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
