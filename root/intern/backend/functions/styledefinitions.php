<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   styledefinitions.php           //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Css-Verlinkungen             //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 27.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Orientiert an:http://dev.eyedea.eu/samples/styleswitch-php/

$styleSheets = array();
$styleSheets[0]["text"]='dark';
$styleSheets[0]["title"]='select dark page design';
$styleSheets[0]["sheet"]='<link href="../../css/dark.css" rel="stylesheet" type="text/css" /><style> 
@font-face{
   font-family:               "Roboto";
   font-size:                 1rem;
   font-display:              swap;
   src:                       local(Roboto),
                              local(Roboto-Regular),
                              url("../fonts/Roboto/Roboto-Regular.ttf") format("truetype");
                              body {font-family: "Roboto", sans-serif;}</style>';

$styleSheets[1]["text"]='light';
$styleSheets[1]["title"]='select light page design';
$styleSheets[1]["sheet"]='<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" /><style> 
<style>
   @font-face {
   font-family: "InriaSerif";
   font-size: 1rem;
   font-display: swap;
   src: local(InriaSerif), local(InriaSerif-Regular),
     url("../fonts/InriaSerif/InriaSerif-Regular.ttf") format("truetype");
 }
 body {
   font-family: "InriaSerif", serif;

 };</style>';

// Default
$defaultStyleSheet=0;

// Schreibe Stylewahl in Cookie
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