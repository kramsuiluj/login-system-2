<?php 

require_once 'user.php';

$name = 'login-system';
$host = 'localhost';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$name";

try{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die('There was an error while connection to the database: ' . $e->getMessage());
}

$user = new User($pdo);

?>