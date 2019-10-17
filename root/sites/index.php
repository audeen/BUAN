<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:  index.php                       //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Startseite                   //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 11.10.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();
/* include ("../../config/config.php"); */


echo "<!doctype html>";
echo "<html>";
echo "<head>";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">";
echo "<title>Start</title>";   
echo "</head>";
/* include ("../control/control.php"); */
echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">";
echo "<body>";

    echo "<div id=\"top\">";/* Top Begin */

        echo "<div class=\"container\">";
        
            echo "<div class=\"col-md-6 offer\">";

                echo "<a href=\"#\" class=\"btn btn-success btn-sm\">Welcome</a>";
                echo "<a href=\"checkout.php\">Total Price: €300 | 4 Items in your Cart</a>";

                    echo "<div class=\"col-md-6\">\n";
                        echo "<ul class=\"menu\">\n";

                        echo "<li>\n";
                            echo "<a href=\"checkout.php\">Checkout</a>\n";
                        echo "</li>\n";

                        echo "<li>\n";
                            echo "<a href=\"cart.php\">Go to Cart</a>\n";
                        echo "</li>\n";

                        echo "<li>\n";
                            echo "<a href=\"../intern/sites/login_backend.php\">Login Backend</a>\n";
                        echo "</li>\n";
                        
                        echo "<li>\n";
                            echo "<a href=\"cart.php\">Login Commercial Agent</a>\n";
                        echo "</li>\n";



                        echo "</ul>";
                    
                    echo "</div>";

            echo "</div>";

        echo "</div>";

    echo "</div>";/* Top Finish */


echo "<script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>";
echo "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>";

echo "</body>";
echo "</html>";

?>