<?php

 include("conn.php");

 $id = $_GET['id'];


 $getResultuser = mysqli_query($conn,"DELETE FROM rentaldetails WHERE id = '$id'");
 

 header("Location:../dashboard.php");



?>