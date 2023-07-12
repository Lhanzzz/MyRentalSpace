<?php
$localhost = "localhost";
$user = "root";
$pass = "";
$database = "silong";


$conn = mysqli_connect($localhost, $user, $pass ,$database);

if(!$conn)
{
    echo"connection error";

}


?>