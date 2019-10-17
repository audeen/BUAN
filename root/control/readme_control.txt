--- README_CONTROL.TXT --- 2019-04-22 --- R#*!&Z ---


CONTENTS OF THIS FILE
---------------------

* Introduction

* Requirements

* Installation

* Configuration

* History


INTRODUCTION
------------
Das vorliegende Verzeichnis habe ich als Tool zur Entwicklung und Debuggen von Aufgaben im Studium MultiMediaProduktion an der FH-Kiel entwickelt.
Die Kontroll-Ausgabe setze ich vorwiegend fuer PHP, darin HTML UND CSS, ein, auch in Verbindung mit MySQL. 
In der Kontroll-Ausgabe werden mir gesetzte Variablen und Arrays und deren Wert angezeigt. Zudem gibt es eine Fehler Ausgabe ueber 'error_ge_last'.
Die Arrays beihnalten bis jetzt $_POST, $_SESSION, $_COOKIES.
Die Ausgabe dient der Uebersicht bei der Entwicklung von Webseiten mit php. 
Aus einer Spielwiese erlernter Faehigkeiten ist sie entstanden.
Angefangen zu entwicklen habe ich sie im Rahmen des Moduls 'Dynamische Webseiten II' im Wintersemester 2018/19 an der FH-Kiel und entwickle sie mit weiterem Wissen und Anforderungen weiter.


REQUIREMENTS
------------
--To Be Done
PHP ?*
APACHE ?* (lokaler server)


INSTALLATION
------------
Der 'control' Ordner ist in dem Ordner zu platzieren in dem sich die Ordner mit den zu entwicklenden php skriten befinden.
Per "include ("../control/control.php");" unmittelbar nachdem HTML body-TAG fuegt sich die Kontrolstruktur in die Seite bzw. den Body mit ein
Das Mehrdimensionale Array 'var_control.php' ist in dem Ordner der zu entwickelnden PHP-Datei, Seite, etc. zu platzieren und kann entsprechend mit Variablen gefuellt werden.


Beispiel Verzeichnisstruktur

*/
├── config/
|     ├── config.php
|     ├── *.php
|     └── ...
|
├── control/
|     ├── control_functions.php
|     ├── control_hover.css
|     ├── control_static.css
|     ├── control.php
|     ├── readme_control.txt
|     └── var_control.php (Kopieren in Seiten Ordner)
|
├── Beispiel Seite/
|     ├── beispiel.php
|     ├── var_control.php
|     ├── etc.php
|     └── ...
|
├── Beispiel Seite2/
|     ├── beispiel2.php
|     ├── var_control.php
|     ├── etc.php
|     └── ...


CONFIGURATION
-------------
In der 'control.php' kann ein default CSS fuer die Darstellung gewaehlt werden. 


HISTORY
-------
V2.4  April 2019                 Pruefung, ob Session gestartet; Datenbank Einbindung Ausgabe; Eingebundene Dateien Anzeige

V2.*  Maerz 2019                 eigene Ordner, Array Ausgabe mit foreach, Dynamisches einbinden, Variablen Array, Error Ausgabe, CSS Switch, Return To Zero

V1.*  September-Dezember 2018    Anfang Entwicklung
