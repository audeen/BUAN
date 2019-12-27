<?php
//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   styleswitch.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Cookie für Stlye             //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 27.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

// Orientiert an:http://dev.eyedea.eu/samples/styleswitch-php/

// Cookie für ein Jahr setzen
if(isset($_REQUEST["SETSTYLE"])){
   
      setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400,"/");
} 


// Seite neu laden 
echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
?> 