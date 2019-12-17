<?php
// Orientiert an:http://dev.eyedea.eu/samples/styleswitch-php/
// Cookie für ein Jahr setzen
if(isset($_REQUEST["SETSTYLE"])){
   
      setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400,"/");
} 


// Seite neu laden 
echo "<meta http-equiv=\"refresh\" content=\"0;url=../sites/index.php\">";
?> 