<?php
$time_start = microtime(true);
/////////////////////////////////////////////////////////////////
//  Debugging - control.php                                    //
//  Fachbereich Medien FH-Kiel - 4.Semester                    //
//  Beschreibung    : Variables-Arrays-Files-Error Debugging   //
//  Ersteller       : Johannes Rebitz                          //
//  Stand           : 28.04.2019                               //
    $version        = "2.9";                                   //
/////////////////////////////////////////////////////////////////

if(session_status() != PHP_SESSION_ACTIVE)
{
   session_start();
}

include ("config/control_config.php");

// SESSION + COOKIE Destroy /////////////////////////////////////
if(isset($_POST['destroy']))
{
   // SESSION to NULL
   if(session_status() == PHP_SESSION_ACTIVE)
   {
      session_destroy();
   }
   // COOKIES to NULL
   foreach($_COOKIE as $output)
   {
      $output = '';
      setcookie(key($_COOKIE), '', time() -3600);
      next($_COOKIE);
   }
   echo "<meta http-equiv=\"refresh\" content=\"0;url=#\">";
}

// CSS SWITCH static <=> hover //////////////////////////////////
if(isset($_POST['css_switch']))
{
   $_SESSION['css_switch'] = $_POST['css_switch'];
   CSS_Switch($_SESSION['css_switch']);
}

if(!isset($_SESSION['css_switch']))
{
   // Set in css_config.php
   CSS_Switch($default_css);
}
else
{
   CSS_Switch($_SESSION['css_switch']);
}

// CSS OPEN + CLOSE OUTPUTS /////////////////////////////////////
if(isset($_SESSION['open_close']))
{
   $open_close = $_SESSION['open_close'];
}
if(isset($_POST['button_open_close']))
{
   $open_close = Open_Close($_POST['button_open_close'], $open_close);
   unset($_POST['button_open_close']);
   $_SESSION['open_close'] = $open_close;
}
if(isset($_SESSION['open_close']))
{
   $value_counts_array = CountArrayValue($open_close, 0, "control_values_open", 3);
   if($value_counts_array >= 2)
   {
      $open_close[-1][1] = $hide_b;
      $open_close[-1][2] = $close_b;
   }
   else
   {
      $open_close[-1][1] = $open_b;
      $open_close[-1][2] = $hide_b;
   }
}

// SECTION CONTROL DATA /////////////////////////////////////////
if(!isset($_POST['button_constants']))
{
   $def_con_css = "control_defined_constants_hide";
   $def_con_button_show = "button_control_data";
   $def_con_button_hide = "button_control_data_hide";
}
else
{
   if($_POST['button_constants'] == "show")
   {
      $def_con_css = "control_defined_constants_show";
      $def_con_button_show = "button_control_data_hide";
      $def_con_button_hide = "button_control_data";
   }
   else
   {
      $def_con_css = "control_defined_constants_hide";
      $def_con_button_show = "button_control_data";
      $def_con_button_hide = "button_control_data_hide";
   }
}

if(!isset($_POST['button_server']))
{
   $server_css = "control_defined_constants_hide";
   $server_button_show = "button_control_data";
   $server_button_hide = "button_control_data_hide";
}
else
{
   if($_POST['button_server'] == "show")
   {
      $server_css = "control_defined_constants_show";
      $server_button_show = "button_control_data_hide";
      $server_button_hide = "button_control_data";
   }
   else
   {
      $server_css = "control_defined_constants_hide";
      $server_button_show = "button_control_data";
      $server_button_hide = "button_control_data_hide";
   }
}  
// END OPEN + CLOSE OUTPUTS /////////////////////////////////////
/////////////////////////////////////////////////////////////////

// HTML Structure (integrates in existing body) /////////////////
echo "<div class=\"activate_control\">";
   echo "<div class=\"control\">";
      echo "<a name=\"top\"></a>";
      // BUTTON Return To Zero => Destroy Session & Cookies
      echo "<form class=\"control_rtz\" action=\"#\" method=\"POST\">";
         echo "<input class=\"button_destroy\" type=\"submit\" name=\"destroy\" value=\"RETURN TO ZERO\">";
      echo "</form>";
      // SWITCH CSS hover <=> static
      echo "<form class=\"control_css_switch\" action=\"#\" method=\"POST\">";
         echo "<input class=\"button_switch\" type=\"submit\" name=\"css_switch\" value=\"hover\">";
         echo "<input class=\"button_switch\" type=\"submit\" name=\"css_switch\" value=\"static\">";
      echo "</form>";
      // HEADLINE
      echo "<div class=\"control_h\">";
         echo "<b>PHP DEBUGGING</b>";
      echo "</div>";
      echo "<div class=\"control_h2\">";
         echo "<b>ARE YOU SURE??</b>";
      echo "</div>";
      // BODY
      echo "<div class=\"control_b\">";
         echo "<div class=\"control_data\">";
            // DISPLAY SESSIONSTATUS
            echo "SESSIONSTATUS: ";
            echo sessionstatus(session_status());
            br(1);
            // DISPLAY LAST CHANGE SCRIPT
            echo "LAST CHANGE: ". date("d.m.y H:i:s", getlastmod());
         echo "</div>";
         OC_Button($open_close, -1, "open_all", "close_all", "ALL");

         // OUTPUT MANUAL VARIABLES FROM var_control.php ////////
         if(!empty($var_control[1][1]))
         {
            OC_Button($open_close, 0, "open_vars", "close_vars", "VARIABLEN BELEGUNG");
            echo "<div class=\"".$open_close[0][0]."\">";
               $count_vars = count($var_control);
               echo "<ins>Manual Variables: </ins>";
               for ($i = 1; $i <= $count_vars; $i++)
               {
                  if(!empty($var_control[$i][1]))
                  {
                     echo "<li>";
                        echo "[".$var_control[$i][1]."]: ";
                        echo $var_control[$i][2];
                     echo "</li>";
                  }
               }
               strich(13);
            echo "</div>";
         }
         
         // OUTPUT MYSQLI QUERY ACTUAL RELATION TABLE ///////////
         if(!empty($row))
         {
            OC_Button($open_close, 1, "open_mysqli", "close_mysqli", "MYSQLI QUERY");
            echo "<div class=\"".$open_close[1][0]."\">";
            CheckPrintArray($row, key($pdo));
            echo "</div>";
         }
         
         // OUTPUT EXISTING PHP-ARRAYS //////////////////////////
         if(!empty($_POST || session_status() == PHP_SESSION_ACTIVE || $_COOKIE))
         {
            OC_Button($open_close, 2, "open_arrays", "close_arrays", "PHP ARRAYS");
         }
         echo "<div class=\"".$open_close[2][0]."\">";
            CheckPrintArray($_POST, "\$_POST");
            // unset($_SESSION['open_close']);
            CheckPrintArray($_SESSION, "\$_SESSION");
            CheckPrintArray($_COOKIE, "\$_COOKIE");
         echo "</div>";

         // OUTPUT INCLUDED FILES ///////////////////////////////
         $exclude_files = getDirectoryContent($control_dir);
         $files = setIncludedFiles($exclude_files);
         // $files = get_included_files(); 
         if(!empty($files))
         {
            OC_Button($open_close, 3, "open_files", "close_files", "INCLUDED FILES");
            echo "<div class=\"".$open_close[3][0]."\">";
               RecursiveArrayLoop($files);
               br(1).strich(23);
               br(2);
            echo "</div>";
         }

         // ERROR OUTPUT ////////////////////////////////////////
         $error = error_get_last();
         CheckPrintArray($error, "LAST ERROR");

         // CONTROL DATA ////////////////////////////////////////
         echo "<div class=\"control_data\">";
            // OPEN PHPINFO.PHP IN NEW TAB
            echo "<div class=\"control_data_button\">";
               echo "<a href=\"".__FILE__."/../sites/phpinfo.php\" target=\"_blank\">";
                  echo "<button class=\"button_control_data\">OPEN PHP INFO</button>";
               echo "</a>";
            echo "</div>";

            // DISPLAY $_SERVER ARRAY
            echo "<div class=\"control_data_button\">";
               echo "<form action=\"#\" method=\"POST\">";
                  echo "<button class=\"$server_button_show\" type=\"submit\" name=\"button_server\" value=\"show\">SHOW \$_SERVER ARRAY</button>";
                  echo "<button class=\"$server_button_hide\" type=\"submit\" name=\"button_server\" value=\"hide\">HIDE \$_SERVER ARRAY</button>";
               echo "</form>";
            echo "</div>";
            echo "<div class=\"".$server_css."\">";
               RecursiveArrayLoop($_SERVER);
            echo "</div>";

            // DISPLAY DEFINED PHP CONSTANTS 
            echo "<div class=\"control_data_button\">";
               echo "<form action=\"#\" method=\"POST\">";
                  echo "<button class=\"$def_con_button_show\" type=\"submit\" name=\"button_constants\" value=\"show\">SHOW DEFINED CONSTANTS</button>";
                  echo "<button class=\"$def_con_button_hide\" type=\"submit\" name=\"button_constants\" value=\"hide\">HIDE DEFINED CONSTANTS</button>";
               echo "</form>";
            echo "</div>";
            echo "<div class=\"".$def_con_css."\">";
               $defined_constants = get_defined_constants();
               RecursiveArrayLoop($defined_constants);
            echo "</div>";

            echo "<div>";
               // DISPLAY CURRENT USER
               echo "CURRENT USER: ".get_current_user();
               br(1);
               // DISPLAY PHP VERSION
               echo "PHP VERSION: ".phpversion();
               br(1);
               // DISPLAY DEBUG VERSION
               echo "DEBUG VERSION: ".$version;
               br(1);
               // DISPLAY EXECUTION TIME SCRIPT DEBUG
               $time_end = microtime(true);
               $execution_time = round(($time_end - $time_start),3);
               echo "EXECUTION-TIME DEBUG-SCRIPT: ".$execution_time."s";
               br(3);
            echo "</div>";
         // END DIV CLASS control_data
         echo "</div>";
      // END DIV CLASS control_b
      echo "</div>";
      // BUTTON UP
      echo "<div class=\"control_to_top\">";
      echo "<a class=\"control_button_up\" href=\"#top\">BACK TO TOP</a>";        
   echo "</div>";
   // END DIV CLASS control
   echo "</div>";
// END DIV CLASS activate_control
echo "</div>";
/////////////////////////////////////////////////////////////////
//                      END OF FILE                            //
/////////////////////////////////////////////////////////////////
?>