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
    $pass=$_POST['password'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    $sql = "SELECT user FROM userdata WHERE user = :user";
    $result = $pdo->query($sql);
    if($result->rowCount() != 0){
        echo "the names taken homie";
    }
    else{
        $sql = "INSERT INTO userdata (user,pass) VALUES (:user,:pass)";
        $statement=$pdo->prepare($sql);
        $statement->bindParam(":user", $user);
        $statement->bindParam(":pass", $hashedPass);
        $statement->execute();
        echo "success. log in now";
        header('Location: index.php');
        die;
    }
}
?>