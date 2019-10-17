<?php

/////////////////////////////////////////////////////////////////
//  Debugging - control_functions.php                          //
//  Fachbereich Medien FH-Kiel - 4.Semester                    //
//  Beschreibung    : Functions for control.php                //
//  Ersteller       : Johannes Rebitz                          //
//  Stand           : 05.10.2019                               //
//  version         : 1.2                                      //
/////////////////////////////////////////////////////////////////

// Break Function ///////////////////////////////////
function br($br)
{
   for ($i = 1; $i <= $br; $i++)
   {
      echo "<br>";
   }
}
/////////////////////////////////////////////////////

// Strich Function //////////////////////////////////
function strich($strich)
{
   for ($i = 1; $i <= $strich; $i++)
   {
      echo "&nbsp;-&nbsp;";
   }
}
/////////////////////////////////////////////////////

// sessionstatus in STRING Function /////////////////////////////
function sessionstatus()
{
   switch(session_status())
   {
      case(0):
      {
         echo "DISABLED";
         break;
      }
      case(1):
      {
         echo "NONE";
         break;
      }
      case(2):
      {
         echo "ACTIVE";
         break;
      }
      default:
      {
         break;
      }
   }
}
/////////////////////////////////////////////////////////////////

// Check if Array is !empty => RecursiveArrayLoop ///////////////
function CheckPrintArray($array, $array_name)
{
   if(!empty($array))
   {
      echo "<h3>".$array_name."</h3>";
      RecursiveArrayLoop($array);
      br(2);
      // var_dump($array);
      br(1).strich(23);
      br(2);
   }
}
/////////////////////////////////////////////////////////////////

// REKURSIVE ARRAY FOREACH LOOP /////////////////////////////////
function RecursiveArrayLoop($array) 
{
   foreach ($array as $key => $value) 
   {
      if (is_array($value)) 
      {
         echo "[".$key."]".br(1);
         RecursiveArrayLoop($value);
      } 
      else 
      {
         next($array);
         echo "[".$key."]: ".$value;
         br(2);
      }
   }
}
/////////////////////////////////////////////////////////////////

// Count specified Keys in Array ////////////////////////////////
function CountArrayValue($array, $key, $value, $count)
{
   $value_counts_array = 0;
   for ($i = 0; $i <= $count; $i++)
   {
      if($array[$i][$key] == $value)
      {
         $value_counts_array++;
      }
   }
   return $value_counts_array;
}
/////////////////////////////////////////////////////////////////

// Recursive Directory Loop /////////////////////////////////////
function getDirectoryContent($dir, &$results = array())
{
   $files = scandir($dir);

   foreach ($files as $key => $value) 
   {
      $path = realpath($dir."/".$value);
      if(!is_dir($path))
      {
         $results[] = $path;
      }
      else if($value != "." && $value != "..")
      {
         getDirectoryContent($path, $results);
         $results[] = $path;
      }
   }  
   return $results;
}
/////////////////////////////////////////////////////////////////

// Function exclude control folder //////////////////////////////
function setIncludedFiles($exclude_files)
{
   $files = get_included_files();
   $intersect = array_intersect($exclude_files, $files);
   return array_diff($files, $intersect);
}
/////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////
//                      END OF FILE                            //
/////////////////////////////////////////////////////////////////
?>