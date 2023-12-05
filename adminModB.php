<?php
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
    $user=$_POST['username'];
    $thing=$_POST['thing'];
    $sql = "SELECT * FROM userdata WHERE user = :user";
    $result = $pdo->query($sql);
    if($result->rowCount() == 0){
        echo 'user cannot be found';
    }
    else{
        $sql = "UPDATE favorit SET thing = :thing WHEN user = :user";
        $statement=$pdo->prepare($sql);
        $statement->bindParam(":thing", $thing);
        $statement->execute();
    }
}