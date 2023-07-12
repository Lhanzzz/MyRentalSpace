<?php
include("php/conn.php");
session_start();
if(is_null($_SESSION['userId'])){
    echo $_SESSION['userId'];
    header("location:login.php");
}
$id = $_SESSION['userId']??'';
$getuser = mysqli_query($conn,"SELECT * FROM user_acc WHERE id = '$id'");
$row = mysqli_fetch_assoc($getuser);
$author_name = $row["full_name"];

if (isset($_POST['submit']))
{
    $rentalName = $_POST['rentalName'];
    $rentalAddress = $_POST['rentalAddress'];
    $rentalPrice = $_POST['price'];
    $description = $_POST['description'];
    $bathroom = $_POST['bathroom'];
    $bedroom = $_POST['bedroom'];
    $house = $_POST['house'];
    $beds = $_POST['beds'];
    $pets = $_POST['pets'];
    $capacity = $_POST['capacity'];
    
    $randomNumber = mt_rand(1, 99999);

    $targetDirectory = "img/" . $randomNumber . "/";
    $maxFiles = 6;

    if (!is_dir($targetDirectory)) {
        if (mkdir($targetDirectory, 0777, true)) {
            echo "Folder created successfully.";
        } else {
            echo "Failed to create the folder.";
        }
    } 
    else {
        echo "The folder already exists.";
    }
    $fileCount = count($_FILES["fileToUpload"]["name"]);
    $uploadedFiles = 0; 
    $uploadedFilespath = ""; 

    for ($i = 0; $i < $fileCount; $i++) {
      $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"][$i]);
      

      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  
      // Check if the file is an actual file or a fake file
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
  
      // Check if the file already exists
      if (file_exists($targetFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
      }
  
      // Check file size (limit it to 2MB in this example)
      if ($_FILES["fileToUpload"]["size"][$i] > 2 * 1024 * 1024) {
        echo "Sorry, the file is too large. Maximum file size allowed is 2MB.";
        $uploadOk = 0;
      }
  
      // Allow only specific file formats (you can modify this as per your requirement)
      $allowedFormats = array("jpg", "jpeg", "png", "gif");
      if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
      }
  
      // If all checks pass, try to upload the file
      if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $targetFile)) {
          echo "The file " . basename($_FILES["fileToUpload"]["name"][$i]) . " has been uploaded.<br />";
          $uploadedFilespath .= $targetFile.",";
          $uploadedFiles++;
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
  
      // Break the loop if the maximum number of files is reached
      if ($uploadedFiles >= $maxFiles) {
        echo "Maximum number of files reached. Only the first $maxFiles files were uploaded.";
        break;
      }
    }

  
    // $files = explode(",", $uploadedFilespath);

    //     // Trim whitespace from each file path
    //     $files = array_map('trim', $files);

    //     // Loop through the file paths
    //     foreach ($files as $filePath) {
    //     echo $filePath . "<br>";
    //     }

    $sql = "INSERT INTO rentaldetails (rentalName, rentalAddress, rentalPrice, description,overview,author_id,author_name, bathroom, Bedroom, house_type, beds, pets, Capacity) VALUES ('$rentalName', '$rentalAddress', '$rentalPrice', '$description','$uploadedFilespath','$id','$author_name','$bathroom','$bedroom','$house','$beds','$pets','$capacity')";
    $result = mysqli_query($conn, $sql);
    header("Location:dashboard.php");
          
}     



?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/addapartment.css">
    <script src="https://kit.fontawesome.com/904a5ca53d.js" crossorigin="anonymous"></script>
    <title>SILONG.MNL</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="img/silongLogo.png">
                <div class="links">
                    <a href="homapage.html">Home</a>
                    <a href="dashboard.php">Dashboard</a>
                    
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
        <div class="containerimage">
            <div class="flex-1">
                <img src="img/rental/rental1.png">

            </div>
            <div class="flex-2">
                <img src="img/rental/rental1.png">
                <img src="img/rental/rental1.png">
            </div>
            <div class="flex-3">
                <img src="img/rental/rental1.png">
                <img src="img/rental/rental1.png">
            </div>
        </div>
        <form method="post" action=""class="rental-content" enctype="multipart/form-data">
            <div class="RentalDetails">
                <div class="RentalTitle">
                    <p><input type="text" name="rentalName" placeholder="Title Name" required></p>
                </div>
                <div class="RentalAddress">
                    <p><input type="text" name="rentalAddress" placeholder="Address" required></p>
                    <p>Author: <?php echo $author_name;?></p>
                    
                    
                    
                </div>
                <div class="RentalPrice">
                    <p>₱ <input type="text" name="price" placeholder="XX,XXX" required> /monthly </p>
                </div>
                <div class="app">
                        <div class="buttonIMG">
                            <i class="fa-solid fa-toilet" style="color: #ffffff;"></i>
                            <p>Bathroom:<input type="text" name="bathroom" value = "1"></p>
                        </div>
                        <div class="buttonIMG">
                            <i class="fa-solid fa-bed" style="color: #ffffff;"></i>
                            <p>Bedroom: <input type="text" name="bedroom"value = "1"></p>
                        </div>
                        <div class="buttonIMG">
                            <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                            <p>House Type:<input type="text" name="house"value = "1"></p>
                        </div>
                </div>
                <div class="app">
                    <div class="buttonIMG">
                        <i class="fa-solid fa-bed" style="color: #ffffff;"></i>
                        <p>Beds:<input type="text" name="beds"value = "1"></p>
                    </div>
                    <div class="buttonIMG">
                        <i class="fa-solid fa-dog" style="color: #ffffff;"></i>
                        <p>Pets:<input type="text" name="pets" value = "Not Allowed"></p>
                    </div>
                    <div class="buttonIMG">
                    <i class="fa-solid fa-people-group"></i>
                        <p>Capacity:<input type="text" name="capacity" value = "1"></p>
                    </div>
            </div>

                <div class="RentalDetails1">
                    <p id="Description">Description</p>
                    <p><textarea rows="10" name="description" required >Example:Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel illo nihil corporis deleniti, ex aliquam ducimus excepturi rem eveniet quaerat reiciendis impedit dolore, quisquam tempore harum inventore. Laudantium, totam eligendi!. </textarea></p>
                </div>
            </div>

            <div class="fillupcontainer">
            <div class="fillup">
                <input type="file" name="fileToUpload[]" multiple="multiple" accept="image/*" required />
                <input type="submit" name="submit" placeholder="" value="Upload">
                
            </div>
            </div>
            
        </form>
      
    
    
    </main>

    
</body>
</html>