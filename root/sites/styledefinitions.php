<?php
$styleSheets = array();
//http://dev.eyedea.eu/samples/styleswitch-php/
// DEFINE STYLESHEETS
$styleSheets[0]["text"]='dark';
$styleSheets[0]["title"]='select dark page design';
$styleSheets[0]["sheet"]='<link href="../css/dark.css" rel="stylesheet" type="text/css" /><style> 
@font-face{
   font-family:               "Roboto";
   font-size:                 1rem;
   font-display:              swap;
   src:                       local(Roboto),
                              local(Roboto-Regular),
                              url("../fonts/Roboto/Roboto-Regular.ttf") format("truetype");
                              body {font-family: "Roboto", sans-serif; font-size: 16px;}</style>';

$styleSheets[1]["text"]='light';
$styleSheets[1]["title"]='select light page design';
$styleSheets[1]["sheet"]='<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style> 
@font-face{
   font-family:               "InriaSerif";
   font-size:                 1rem;
   font-display:              swap;
   src:                       local(InriaSerif),
                              local(InriaSerif-Regular),
                              url("../fonts/InriaSerif/InriaSerif-Regular.ttf") format("truetype");
                              body {font-family: "InriaSerif", serif; font-size: 16px;}</style>';

// DEFAULT STYLESHEET
$defaultStyleSheet=0;

// SET STYLESHEET
if(!isset($_COOKIE["STYLE"])){
   if(isset($_SESSION["STYLE"])){
      echo $styleSheets[$_SESSION["STYLE"]]["sheet"];
   } else {
      echo $styleSheets[$defaultStyleSheet]["sheet"];
   }
   } else {
      echo $styleSheets[$_COOKIE["STYLE"]]["sheet"];
}
?> 