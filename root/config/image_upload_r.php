<?php
include ('config.php');
 
 if(isset($_POST['update']))
 {
  $pdo; 
  $imgFile = $_FILES['image']['name'];
  $tmp_dir = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];
  $id_r = $_POST['id_r'];
  
  
   $upload_dir = '../../images/'; // upload directory
 
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
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $pdo->prepare('INSERT INTO r_images(ri_name, image, id_ri) VALUES(:ri_name, :image, :id_ri)');
   $stmt->bindParam(':ri_name',$imgFile);
   $stmt->bindParam(':image',$image);
   $stmt->bindParam(':id_ri',$id_ri);
   
   if($stmt->execute())
   {
    $successMSG = "new record succesfully inserted ...";
    /* echo "<script type='text/javascript'>window.location='retailer_show.php'; </script>";; // redirects image view page after 5 seconds. */
   }
   else
   {
    $errMSG = "error while inserting....";
   }
  }