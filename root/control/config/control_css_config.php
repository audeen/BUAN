<?php

/////////////////////////////////////////////////////////////////
//  Debugging CSS Config - css_config.php                      //
//  Fachbereich Medien FH-Kiel - 4.Semester                    //
//  Beschreibung    : Config CSS for control.php               //
//  Ersteller       : Johannes Rebitz                          //
//  Stand           : 29.04.2019                               //
//  Version         : 1.0                                      //
/////////////////////////////////////////////////////////////////

include ("control_css_functions.php");

// Comment - Uncomment for default CSS //////////////////////////
//$default_css = "hover";
$default_css = "static";
/////////////////////////////////////////////////////////////////

// Included CSS Style Files /////////////////////////////////////
echo "<link rel=\"stylesheet\" href=\"../../../control/css/default.css\" type=\"text/css\">";
echo "<link rel=\"stylesheet\" href=\"../../../control/css/buttons.css\" type=\"text/css\">";

// Open Close Data defaults /////////////////////////////////////
$open_b = "button_ud_open";
$close_b = "button_ud_close";
$hide_b = "button_ud_hide";
$open_c = "control_values_open";
$hide_c = "control_values_close";

// open close_all
$open_close [-1][1] = $open_b;
$open_close [-1][2] = $hide_b;
// variables
$open_close [0][0] = $hide_c;
$open_close [0][1] = $open_b;
$open_close [0][2] = $hide_b;
// mysqli
$open_close [1][0] = $hide_c;
$open_close [1][1] = $open_b;
$open_close [1][2] = $hide_b;
// arrays
$open_close [2][0] = $hide_c;
$open_close [2][1] = $open_b;
$open_close [2][2] = $hide_b;
// files
$open_close [3][0] = $hide_c;
$open_close [3][1] = $open_b;
$open_close [3][2] = $hide_b;
/////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////
//                      END OF FILE                            //
/////////////////////////////////////////////////////////////////
?>