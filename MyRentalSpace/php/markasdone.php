<?php
include("conn.php");
$id = $_GET['id'];

$getTenantdetails = mysqli_query($conn,"SELECT * FROM approve WHERE id = '$id'");
$row = mysqli_fetch_assoc($getTenantdetails);

$rentalName = $row['rentalName'];
$tenantName = $row['tenantName'];
$date = $row['date'];
$time = $row['time'];
$number = $row['contact_number'];
$author_id = $row['author_id'];

$sql = "INSERT INTO viewed (rentalName, tenantName, date,time,contact_number,author_id) VALUES ('$rentalName', '$tenantName', '$date', '$time','$number','$author_id')";
$result = mysqli_query($conn, $sql);

$getResultuser = mysqli_query($conn,"DELETE FROM approve WHERE id = '$id'");
header("Location:../approved.php");

?>