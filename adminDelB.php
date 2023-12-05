<?php
$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$password = "root";
try{
    $pdo = new PDO($dsn,$username,$password);
}
catch(PDOException $e){
    die("err".$e->getMessage());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user=$_POST['username'];
    $sql = "SELECT user FROM userdata WHERE user = :user";
    $result = $pdo->query($sql);
    if($result->rowCount() == 0){
        echo "user does not exist";
    }
    else{
        $sql = "DELETE FROM userdata WHERE user = :user";
        $statement=$pdo->prepare($sql);
        $statement->execute();
    }
}