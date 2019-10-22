<?php
// SET COOKIE FOR 1 YEAR
if(isset($_REQUEST["SETSTYLE"])){
if(setcookie("testcookie",true)){
setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400,"/");
} else {
$_SESSION["STYLE"]=$_REQUEST["SETSTYLE"];
}
}

// RETURN TO CURRENT PAGE
echo "<script type='text/javascript'>window.location='admin_show.php'; </script>";
?> 