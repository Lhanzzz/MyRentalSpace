<?php
include("php/conn.php");


     

session_start();
if(is_null($_SESSION['userId'])){
    echo $_SESSION['userId'];
    header("location:login.php");
}
// GETTING ALL DETAILS OF THE USER
$ids = $_SESSION['userId'];
$getResultuser = mysqli_query($conn,"SELECT * FROM user_acc WHERE id ='$ids'");
$detailuser = mysqli_fetch_assoc($getResultuser);
$FullName = $detailuser['full_name'];
$contact_number = $detailuser['contact_number'];



// GETTING ALL DETAILS OF THE GIVEN SPECIFIC ID
 $id = $_GET["id"];

$getResult = mysqli_query($conn,"SELECT * FROM rentaldetails WHERE id ='$id'");
$details = mysqli_fetch_assoc($getResult);

$rentalName = $details['rentalName'];
$rentalAddress = $details['rentalAddress'];
$rentalPrice = $details['rentalPrice'];
$description = $details['description'];
$bathroom = $details['bathroom'];
$bedroom = $details['Bedroom'];
$house = $details['house_type'];
$aname = $details['author_name'];
$beds = $details['beds'];
$pets = $details['pets'];
$capacity = $details['Capacity'];


$a_id = $details['author_id'];
$files = explode(",", $details['overview']);
$unangpic = array_map('trim', $files);



if(isset($_POST['submit']))
{
    $tenantName = $_POST["tenant_name"];
    $tenant_number = $_POST["tenant_number"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $userid = $_SESSION['userId'];
    $sql = "INSERT INTO approval (rentalName, tenantName, date, time,contact_number,author_id,user_id) VALUES ('$rentalName','$tenantName','$date','$time', '$tenant_number','$a_id','$userid')";
    $sql1 = "INSERT INTO userhistory (rentalName, tenantName, date, time,contact_number,author_id,user_id,result) VALUES ('$rentalName','$tenantName','$date','$time', '$tenant_number','$a_id','$userid','Pending')";
    mysqli_query($conn, $sql1);
    if ($result = mysqli_query($conn, $sql))
    {
        
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/rentalView.css">
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
        <div class="backbutton">
            <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        
        <div class="containerimage">
        
            <div class="flex-1">
                <img src="<?php echo $unangpic[0]; ?>">

            </div>
            <div class="flex-2">
                <img src="<?php echo $unangpic[1]; ?>">
                <img src="<?php echo $unangpic[2]; ?>">
            </div>
            <div class="flex-3">
                <img src="<?php echo $unangpic[3]; ?>">
                <img src="<?php echo $unangpic[4]; ?>">
            </div>
        </div>
        <div class="rental-content">
            <div class="RentalDetails">
                <div class="RentalTitle">
                    <p><?php echo $rentalName?></p>
                </div>
                <div class="RentalAddress">
                    <p><?php echo $rentalAddress?></p>
                    <p>Author: <?php $aname?></p>
                </div>
                <div class="RentalPrice">
                    <p>₱ <?php echo $rentalPrice?> /monthly </p>
                </div>
                <div class="app">
                        <div class="buttonIMG">
                            <i class="fa-solid fa-toilet" style="color: #ffffff;"></i>
                            <p>Bathroom:<?php echo $bathroom ?></p>
                        </div>
                        <div class="buttonIMG">
                            <i class="fa-solid fa-bed" style="color: #ffffff;"></i>
                            <p>Bedroom: <?php echo $bedroom ?></p>
                        </div>
                        <div class="buttonIMG">
                            <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                            <p>House Type:<?php echo $house ?></p>
                        </div>
                </div>
                <div class="app">
                    <div class="buttonIMG">
                        <i class="fa-solid fa-bed" style="color: #ffffff;"></i>
                        <p>Beds:<?php echo $beds ?></p>
                    </div>
                    <div class="buttonIMG">
                        <i class="fa-solid fa-dog" style="color: #ffffff;"></i>
                        <p>Pets:<?php echo $pets ?></p>
                    </div>
                    <div class="buttonIMG">
                    <i class="fa-solid fa-people-group"></i>
                        <p>Capacity:<?php echo $capacity ?></p>
                    </div>
            </div>

                <div class="RentalDetails1">
                    <p id="Description">Description</p>
                    <p><?php echo $description ?></p>
                </div>
            </div>

            <div class="fillupcontainer">
            <form action="" method="post" class="fillup">
                <h3>SCHEDULE A VISIT RIGHT AWAY!</h3>
                <input type="text" name="tenant_name" placeholder="Full Name" value= "<?php echo $FullName ?>">
                <input type="number" name="tenant_number" placeholder="09XXXXXXXXXX" value="0<?php echo $contact_number ?>">
                <input type="date" name="date" placeholder="Select Data">
                <input type="time" name="time" placeholder="Time">
                <input type="text" placeholder="Onsite Visit" value="Onsite Visit" disabled>
                <input type="submit" name="submit" value="SET SCEHEDULE">
            </form>





            </div>
            
        </div>
      
    
    
    </main>

    
</body>
</html>