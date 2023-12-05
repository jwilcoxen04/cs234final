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
    session_start();
    $user=$_POST['username'];
    $pass=$_POST['password'];
    if($user == 'admin' && $pass == 'admin'){
        $_SESSION["username"] = $user;
        header("Location: adminF.php");
    }
    $sql = "SELECT * FROM userdata WHERE user = :user";
    $result = $pdo->query($sql);
    if($result->rowCount() == 0){
        echo 'user cannot be found';
    }
    else{
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row["password"])) {
           $_SESSION["username"] = $user;
           header("Location: siteF.php");
        } 
        else {
           echo "<p>Incorrect username or password.</p>";
        }
     }
}
?>