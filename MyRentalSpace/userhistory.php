<?php 
session_start();
include("php/conn.php");
$id = $_SESSION['userId'];
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
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/userhistory.css">
    <script src="https://kit.fontawesome.com/904a5ca53d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <title>SILONG.MNL</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="img/silongLogo.png">
                <div class="links">
                    <a href="index.php">Browse</a>
                    <a href="userhistory.php">History</a>
                </div>
            </div>
            <div class="searchcontainer">
                <div class="imgsrch">
                    <input type="text" name="search" placeholder="Search By Location">
                    <button class="searhbtn"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                </div>
                <div class="accountprofile">
                    <i class="fa-solid fa-bars" style="color: #1c1c1c;"></i>
                    <i class="fa-solid fa-user" style="color: #404040;"></i>
                    <div class="dropdown-content">
                        <a href="php/logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket" style="color: #6b6b6b;"></i>Logout</a>
                    </div>
                </div>
                
            </div>
        </nav>
    </header>

    <main>
        <h1>History</h1>
    <table id="myTable">
                <thead>
                  <tr>
                    <th>Rental Name</th>
                    <th>Tenant Name</th>
                    <th>Contact Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>RESULT</th>
                  </tr>
                </thead>
                <tbody>
                 
                    <?php 
                    $result = mysqli_query($conn, "SELECT * FROM userhistory WHERE user_id ='$id'");
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo " <tr>
                                <td>".$row['rentalName']."</td>
                                <td>".$row['tenantName']."</td>
                                <td>".$row['contact_number']."</td>
                                <td>".$row['date']."</td>
                                <td>".$row['time']."</td>
                                <td><a href='#'>".$row['result']."</a></tr>
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
    
    






    
</body>
</html>