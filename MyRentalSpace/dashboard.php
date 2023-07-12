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
    <link rel="stylesheet" href="css/dashboard.css">
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
            <a href="dashboard.php" id="activebutton"><i class="fa-solid fa-house-user" "></i>Rental</a>
            <a href="dashboardsched.php" ><i class="fa-solid fa-gauge"></i>Pending</a>
            <a href="approved.php" ><i class="fa-solid fa-gauge" ></i>Approved</a>
            <a href="cancelled.php"><i class="fa-solid fa-gauge" ></i></i>Cancelled</a>
            <a href="viewed.php"><i class="fa-solid fa-gauge" ></i></i>Viewed</a>
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
                <h2>Rental</h2>
                <a href="addaparment.php"><i class="fa-solid fa-plus" style="color: #ffffff;"></i>Add Rental</a>
                
            </div>
            <div class="tablecontainer"></div>
            <table id="myTable">
                <thead>
                  <tr>
                    <th>Rental Name</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                    <?php 
                    $result = mysqli_query($conn, "SELECT * FROM rentaldetails WHERE author_id ='$id'");
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo " <tr>
                                <td>".$row['rentalName']."</td>
                                <td>".$row['rentalAddress']."</td>
                                <td>".$row['rentalPrice']."</td>
                                <td><a href='php/delete.php?id=".$row['id']."'  ><i class='fa-sharp fa-solid fa-trash' style='color: #000000;'></i></a></tr>
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