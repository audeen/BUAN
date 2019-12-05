<?php

/////////////////////////////////////////////////////////////////
//  Debugging - css_functions.php                              //
//  Fachbereich Medien FH-Kiel - 4.Semester                    //
//  Beschreibung    : Functions forr CSS                       //
//  Ersteller       : Johannes Rebitz                          //
//  Stand           : 29.04.2019                               //
//  version         : 1.0                                      //
/////////////////////////////////////////////////////////////////

// CSS SWITCH ///////////////////////////////////////////////////
function CSS_Switch($css)
{
   echo "<link rel=\"stylesheet\" href=\"../../../control/css/".$css.".css\" type=\"text/css\">";
}
/////////////////////////////////////////////////////////////////

// BUTTON OPEN CLOSE ////////////////////////////////////////////
function OC_Button($open_close, $x, $value_1, $value_2, $txt) 
{
   echo "<form class=\"control_values_h\" action=\"#\" method=\"POST\">";
      echo "<button class=\"".$open_close[$x][1]."\" type=\"submit\" name=\"button_open_close\" value=\"".$value_1."\">".$txt."<div class=\"button_sign\">&#x229E;</div></button>";
      echo "<button class=\"".$open_close[$x][2]."\" type=\"submit\" name=\"button_open_close\" value=\"".$value_2."\">".$txt."<div class=\"button_sign\">&#x229F;</div></button>";
   echo "</form>";
}
/////////////////////////////////////////////////////////////////

// Switch Case Open Close Data //////////////////////////////////
function Open_Close($open_close_me, $open_close) 
{
   switch($open_close_me)
   {
      case("open_all"):
      {
         $open_close[-1][1] = "button_ud_hide";
         $open_close[-1][2] = "button_ud_close";
         $open_close[0][0] = "control_values_open";
         $open_close[0][1] = "button_ud_hide";
         $open_close[0][2] = "button_ud_close";
         $open_close[1][0] = "control_values_open";
         $open_close[1][1] = "button_ud_hide";
         $open_close[1][2] = "button_ud_close";
         $open_close[2][0] = "control_values_open";
         $open_close[2][1] = "button_ud_hide";
         $open_close[2][2] = "button_ud_close";
         $open_close[3][0] = "control_values_open";
         $open_close[3][1] = "button_ud_hide";
         $open_close[3][2] = "button_ud_close";
         return $open_close;
         break;
      }
      case("open_vars"):
      {
         $open_close[0][0] = "control_values_open";
         $open_close[0][1] = "button_ud_hide";
         $open_close[0][2] = "button_ud_close";
         return $open_close;
         break;
      }
      case("open_mysqli"):
      {
         $open_close[1][0] = "control_values_open";
         $open_close[1][1] = "button_ud_hide";
         $open_close[1][2] = "button_ud_close";
         return $open_close;
         break;
      }
      case("open_arrays"):
      {
         $open_close[2][0] = "control_values_open";
         $open_close[2][1] = "button_ud_hide";
         $open_close[2][2] = "button_ud_close";
         return $open_close;
         break;
      }
      case("open_files"):
      {
         $open_close[3][0] = "control_values_open";
         $open_close[3][1] = "button_ud_hide";
         $open_close[3][2] = "button_ud_close";
         return $open_close;
         break;
      }
      case("close_vars"):
      {
         $open_close[0][0] = "control_values_close";
         $open_close[0][1] = "button_ud_open";
         $open_close[0][2] = "button_ud_hide";
         return $open_close;
         break;
      }
      case("close_mysqli"):
      {
         $open_close[1][0] = "control_values_close";
         $open_close[1][1] = "button_ud_open";
         $open_close[1][2] = "button_ud_hide";
         return $open_close;
         break;
      }
      case("close_arrays"):
      {
         $open_close[2][0] = "control_values_close";
         $open_close[2][1] = "button_ud_open";
         $open_close[2][2] = "button_ud_hide";
         return $open_close;
         break;
      }
      case("close_files"):
      {
         $open_close[3][0] = "control_values_close";
         $open_close[3][1] = "button_ud_open";
         $open_close[3][2] = "button_ud_hide";
         return $open_close;
         break;
      }
      case("close_all"):
      {
         $open_close[-1][1] = "button_ud_open";
         $open_close[-1][2] = "button_ud_hide";
         $open_close[0][0] = "control_values_close";
         $open_close[0][1] = "button_ud_open";
         $open_close[0][2] = "button_ud_hide";
         $open_close[1][0] = "control_values_close";
         $open_close[1][1] = "button_ud_open";
         $open_close[1][2] = "button_ud_hide";
         $open_close[2][0] = "control_values_close";
         $open_close[2][1] = "button_ud_open";
         $open_close[2][2] = "button_ud_hide";
         $open_close[3][0] = "control_values_close";
         $open_close[3][1] = "button_ud_open";
         $open_close[3][2] = "button_ud_hide";
         return $open_close;
         break;
      }
      default:
      {
         break;
      }
   }
}
/////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////
//                      END OF FILE                            //
/////////////////////////////////////////////////////////////////
?>