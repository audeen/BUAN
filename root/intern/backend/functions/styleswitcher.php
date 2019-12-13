<?php
// Orientiert an:http://dev.eyedea.eu/samples/styleswitch-php/
// Cookie für ein Jahr setzen
if(isset($_REQUEST["SETSTYLE"])){
   
      setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400,"/");
} 


// Seite neu laden - Vllt tauschen gegen meta-refresh
header("Location: ".$_SERVER["HTTP_REFERER"]);
?> 