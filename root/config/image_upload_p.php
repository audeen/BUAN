<?php
//https://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html



$id_p = $_POST['id_p'];

 if(isset($_POST['update']))
 {

  $pdo; 
  $imgFile = $_FILES['image']['name'];
  $tmp_dir = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];

  
  
   $upload_dir = '../../images/products/'; // upload directory
 
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
   $query = "UPDATE `products`
          SET 
          `p_img` = :p_img

          WHERE 

          `id_p` =:id_p";
   
   $pdoResult = $pdo->prepare($query);

   $pdoExec = $pdoResult->execute(array(
      ":p_img"=>$image,
      ":id_p"=>$id_p));

  }
}