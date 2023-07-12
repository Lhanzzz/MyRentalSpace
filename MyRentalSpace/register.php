<?php


include("php/conn.php");

if(isset($_POST["submit"])){
    $full_name = $_POST["fullName"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmpassword"];
    $user_type = $_POST["usertype"];

    // Perform validation and processing of the form data
    // ...
    
    // Check if the email is already registered in the database
    $query = "SELECT * FROM user_acc WHERE username = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $promt = "Email already registered. Please choose a different email.";
    } else {
        // Check if the password and confirm password match
        if($password === $confirm_password){
            // Insert the user's information into the database
            $insertQuery = "INSERT INTO user_acc (username, password, user_type,full_name,contact_number) VALUES ('$email', '$password', '$user_type', '$full_name','$number')";
            if(mysqli_query($conn, $insertQuery)){
                $promt = "Registration successful!";
                // Redirect the user to a success page or display a success message
                // ...
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $promt = "Password and confirm password do not match.";
        }
    }
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
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
    <form method="post" action=""class="container">
        <p id="title">Create an Account</p>
        <input type="text" name="fullName" placeholder="Full Name">
        <input type="text" name="email" placeholder="Enter Your Email">
        <input type="number" name="number" placeholder="Enter your Contact Number">
        <input type="password" name="password" placeholder="Enter your password">        
        <input type="password" name="confirmpassword" placeholder="Confirm your password">
        <select name="usertype">
            <option value="landlord">Landlord</option>
            <option value="tenant">Tenant</option>
        </select>
        <input type="submit" name="submit" value="Register" id="buttonlogin">
        <p id="error">Already have an account? <a href="login.php">Login Now!</a></p>
        <p><?php echo $promt??'';?></p>
        <div class="footer">
        <a href="">Create an Account</a>
        <a href="#">Recover Account</a>
        </div>
    </form>
</main>






    

    
</body>
</html>