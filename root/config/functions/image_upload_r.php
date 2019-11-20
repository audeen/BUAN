<?php
// https://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html

include ('../../config/config.php');
$image = "";
$id_r =  $_POST['id_r'];


 if(isset($_POST['update']))
 {
  $pdo; 
  $imgFile = $_FILES['image']['name'];
  $tmp_dir = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];
  
   $upload_dir = '../../images/retailer/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $image = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$image);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
    
   // if no error occured, continue ....
   if(!isset($errMSG))
   {
       $query = "UPDATE 
                     `retailer`
                 SET 
                     `r_img` = :r_img
                 WHERE 
                     `id_r` =:id_r";
   
   $pdoResult = $pdo->prepare($query);

   $pdoExec = $pdoResult->execute(array(
      ":r_img"=>$image,
      ":id_r"=>$id_r));

  }
}