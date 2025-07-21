<?php
session_start();
include("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysql_query($conn,$query);
    if(mysql_num_rows($result) === 1){
        $_SESSION['user']=$username;
        header("Location:index.php");
    
    }else { echo"<script>alert(Invalid login credentials!');</scripts>";
    }
}
?>

<!-- HTML Form -->
 <form method="POST">
    <h2>Login </h2>

    Username: <input type="text" name="username" required ><br><br>
    Password: <input type="password" name="password" required ><br><br>
    <input type="submit" value="Login">
</form>