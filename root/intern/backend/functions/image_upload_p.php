<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   image_upload_p.php             //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Bilderupload Produkte        //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Orientiert an:
//https://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html


// Falls Bild nur getauscht wird, Wert aus POST in Variable schreiben
if (isset($_POST['id_p'])){
    $id_p = $_POST['id_p'];
}

//Update gesetzt?
if(isset($_POST['update']))
{
   $pdo; 
   $imgFile = $_FILES['image']['name'];
   $tmp_dir = $_FILES['image']['tmp_name'];
   $imgSize = $_FILES['image']['size'];

   //Uploadverzeichnis wählen
   $upload_dir = '../../../images/products/'; 
   
/*    //Dateiendung auslesen und in Variable schreiben
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); */
  
   // Zugelassene Dateiendungen wählen
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
  
/*    // Bild umbenennen
   $image = rand(1000,1000000).".".$imgExt; */
    
   // Prüfe Dateiendung gegen zugelassene Dateiendungen
   if(in_array($imgExt, $valid_extensions)){   
    // Dateigröße prüfen
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$image);
    }
    else{
     //ÜBERSETZEN
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  
  //Kein Fehler? Dann weiter
  if(!isset($errMSG) && (isset($_POST['id_p'])))
  {
   $query =   "UPDATE
                     `products`
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