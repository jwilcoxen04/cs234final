<?php
session_start();
$user = $_SESSION["username"];
$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$thing = "root";
try{
    $pdo = new PDO($dsn,$username,$thing);
}
catch(PDOException $e){
    die("err".$e->getMessage());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $thing=$_POST['thing'];
    $sql = "INSERT INTO favorite (user,thing) VALUES (:user,:thing)";
    $statement=$pdo->prepare($sql);
    $statement->bindParam(":user", $user);
    $statement->bindParam(":thing", $thing);
    $statement->execute();
}
echo 'thanks. please log out. please.';
?>