<?php

session_start();
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
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://kit.fontawesome.com/904a5ca53d.js" crossorigin="anonymous"></script>

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
        <div class="filtercontainer">
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/bathroom.png">
                        <p>Bathrooms</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/bedroom.png">
                        <p>Bedroom</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/house.png">
                        <p>House Type</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/bedroom.png">
                        <p>Beds</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/capacity.png">
                        <p>Capacity</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="container">
                <div class="headerfilter">
                        <img src="img/filter/price.png">
                        <p>Price Sort</p>
                </div>
                <select>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
        </div>
    </main>
    <div class="content">
    <!-- <h1 id="recommended">Recommeded</h1> -->
    <div class="rentalContainer">
     <?php 
     $result = mysqli_query($conn, "SELECT * FROM rentaldetails");
        while($row = mysqli_fetch_assoc($result))
            
        {
        if (strpos($row['overview'], ',') !== false) 
        {
            $unangpic = [];
            // Split the string into an array using the comma as the delimiter
            $files = explode(",", $row['overview']);

            // Trim whitespace from each file path
            $unangpic = array_map('trim', $files);

            // Loop through the file paths
            // foreach ($files as $filePath) {
            //     echo $filePath . "<br>";
            // }
        } 
            else {
            // Handle the case when there is no comma in the value
            $unangpic = [];
            $unangpic[0] = $row['overview'];
           
            }

      
            echo"
            <a href='rentalview.php?id=".$row['id']."'class='rental'>
                <div class='rentalImage'>
                    <img src='". $unangpic[0]."'>
                </div>
                <div class='rentalInfo'>
                    <div class='rentalTitle'>
                        <p>".$row['rentalName']."</p>
                    </div>
                    <div class='address'>
                        <p>".$row['rentalAddress']."</p>
                    </div>
                    <div class='rentalPrice'>
                        <p>₱  ".$row['rentalPrice']." - Monthly</p>
                    </div>
                </div>
            </a>";
        }
            ?>

     
        
    </div>
    </div>






    
</body>
</html>