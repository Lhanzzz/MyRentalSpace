<?php
session_start();
$id = $_SESSION['userId'];
include("php/conn.php");
if(is_null($_SESSION['userId'])){
    echo $_SESSION['userId'];
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="css/dashboards.css">
    <script src="https://kit.fontawesome.com/904a5ca53d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <title>Dashboard</title>
</head>
<body>
    <header>
    <div class="sidebar">
        <div class="logo">
            <img src="img/silongLogo.png">
        </div>
        <div class="button">
            <a href="dashboard.php"><i class="fa-solid fa-house-user" "></i>Rental</a>
            <a href="dashboardsched.php" ><i class="fa-solid fa-gauge"></i>Pending</a>
            <a href="approved.php" ><i class="fa-solid fa-gauge" ></i>Approved</a>
            <a href="cancelled.php"><i class="fa-solid fa-gauge" ></i></i>Cancelled</a>
            <a href="viewed.php" id="activebutton" ><i class="fa-solid fa-gauge" ></i></i>Viewed</a>
        </div>
    </div>

    <nav>
        <div class="navigator">
        <div class="logo">
            <h2>Landlord</h2>
        </div>
        <div class="accountprofile">
            <i class="fa-solid fa-bars" style="color: #1c1c1c;"></i>
            <i class="fa-solid fa-user" style="color: #404040;"></i>
            <div class="dropdown-content">
                <a href="php/logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket" style="color: #6b6b6b;"></i>Logout</a>
            </div>
        </div>
        </div>
        <main>
            <div class="headertitle">
                <h2>Viewed</h2>
            </div>
            <div class="tablecontainer"></div>
            <table id="myTable">
                <thead>
                  <tr>
                    <th>Rental Name</th>
                    <th>Tenant Name</th>
                    <th>Contact Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                    <?php 
                    $result = mysqli_query($conn, "SELECT * FROM viewed WHERE author_id ='$id'");
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo " <tr>
                                <td>".$row['rentalName']."</td>
                                <td>".$row['tenantName']."</td>
                                <td>".$row['contact_number']."</td>
                                <td>".$row['date']."</td>
                                <td>".$row['time']."</td>
                                <td><a href='#'>Visited</a></tr>
                                ";
                            }
    
                    ?>
                </tbody>
              </table>
            </div>
            
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
              <script>
                    $(document).ready( function () {
                    $('#myTable').DataTable();
                    } );
                </script>
        </main>
    </nav>
    </header>
        



</body>
</html>