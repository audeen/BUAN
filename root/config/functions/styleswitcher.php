<?php
// http://dev.eyedea.eu/samples/styleswitch-php/
// SET COOKIE FOR 1 YEAR
if(isset($_REQUEST["SETSTYLE"])){
   
      setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400,"/");
} 


// RETURN TO CURRENT PAGE
header("Location: ".$_SERVER["HTTP_REFERER"]);
?> 