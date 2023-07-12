<?php

include("php/conn.php");
session_start();

if(isset($_POST["submit"])){
   $username = $_POST["username"];
   $password = $_POST["password"];
    

   $getuser = mysqli_query($conn,"SELECT * FROM user_acc WHERE username = '$username' and password = '$password'");
   

    if($valid = mysqli_num_rows($getuser)> 0)

    {
        $row = mysqli_fetch_assoc($getuser);
        $userId = $row["id"];
        $userType = $row["user_type"];
        $_SESSION["userId"] = $userId;
        $_SESSION["userType"] = $userType;


        $error = "Login Successfully";
        if($userType =="tenant"){
            header("location:index.php");
        }
        else{
            header("location:dashboard.php");
        }
        
    }
    else
    {
        $error = "Invalid username/Password";
    }
   
}







?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<header>
    <nav>
        <div class="navimg">
            <img src="img/silongLogo.png">            
        </div>
        <div class="close">
            <a href="homepage.html">X</a>
        </div>
    </nav>
</header>

<main>
    <form method="post" action="" class="container">
        <p id="title">Log into SILONG.MNL</p>   
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login"  id="buttonlogin">
        <a id="error"><?php echo $error??''; ?></a>
        <div class="footer">
        <a href="register.php">Create an Account</a>
        <a href="#">Recover Account</a>
        </div>
    </form>
</main>



</body>
</html>