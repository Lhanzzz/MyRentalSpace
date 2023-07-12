<?php
include("conn.php");
$id = $_GET['id'];

$getTenantdetails = mysqli_query($conn,"SELECT * FROM approval WHERE id = '$id'");
$row = mysqli_fetch_assoc($getTenantdetails);

$rentalName = $row['rentalName'];
$tenantName = $row['tenantName'];
$date = $row['date'];
$time = $row['time'];
$number = $row['contact_number'];
$author_id = $row['author_id'];
$userid = $row['user_id'];

$sql = "INSERT INTO approve (rentalName, tenantName, date,time,contact_number,author_id,userid) VALUES ('$rentalName', '$tenantName', '$date', '$time','$number','$author_id',$userid)";
$result = mysqli_query($conn, $sql);

$sql1 = "INSERT INTO userhistory (rentalName, tenantName, date, time,contact_number,author_id,user_id,result) VALUES ('$rentalName','$tenantName','$date','$time', '$number','$author_id','$userid','Approve Onsite')";
mysqli_query($conn, $sql1);

$getResultuser = mysqli_query($conn,"DELETE FROM approval WHERE id = '$id'");
header("Location:../dashboardsched.php");

?>