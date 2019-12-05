<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   receipt.php                    //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Abrechnungserstellung        //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 27.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();

include('../../config/config.php');
include($lang_bill);




$retailer = $_POST['retailer'];
$year = $_POST['year'];
$month = $_POST['month'];


$pdo;
$sql =   $pdo->prepare("SELECT * 
            FROM products, retailer, orders 
            WHERE id_r  $retailer
            AND r_id = id_r
            AND id_p = p_id
            AND order_date BETWEEN '$year-$month-01' AND '$year-$month-31'");
$sql->execute();
$row = $sql->fetch();
$time = strtotime($row['order_date']);

if (empty($row)) {
    $sql = $pdo->prepare("SELECT *
          FROM retailer
          WHERE id_r  $retailer");
    $sql->execute();
    $row = $sql->fetch();

 }



//https://www.php-einfach.de/experte/php-codebeispiele/pdf-per-php-erstellen-pdf-rechnung/


$rechnungs_nummer = $_POST['billnumber'];
$rechnungs_datum = date("d.m.Y");
$pdfAuthor = "BUAN";
 
$rechnungs_header = '
<img src="logo.png">
BUAN
Jannik Sievert';
 
$rechnungs_empfaenger = ''.$row['r_prename'].' '.$row['r_surname'].'
'.$row['r_street'].'
'.$row['r_postal'].' '.$row['r_city'].'
'.$row['r_country'].'';
 
$rechnungs_footer = "";

 
$pdfName = "Rechnung_".$rechnungs_nummer.".pdf";





 
 
//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
 
// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.
 
$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
 <tr>
 <td>'.nl2br(trim($rechnungs_header)).'</td>
    <td style="text-align: right">
Rechnungsnummer '.$rechnungs_nummer.'<br>
Rechnungsdatum: '.$rechnungs_datum.'<br>

 </td>
 </tr>
 
 <tr>
 <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Gehaltsabrechnung
<br>
 </td>
 </tr>
 
 
 <tr>
 <td colspan="2">'.nl2br(trim($rechnungs_empfaenger)).'</td>
 </tr>
</table>
<br><br><br>
 
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
 <tr style="background-color: #cccccc; padding:5px;">
 <td style="padding:5px;"><b>Position</b></td>
 <td style="text-align: center;"><b>Produkt</b></td>
 <td style="text-align: center;"><b>Menge</b></td>
 <td style="text-align: center;"><b>Einzelpreis</b></td>
 </tr>';
 
 
$gesamtpreis = 0;



// Positionen zählen


$sql =   ("SELECT * FROM products, retailer, orders 
WHERE id_r $retailer
AND r_id = id_r
AND id_p = p_id
AND order_date BETWEEN '$year-$month-01' AND '$year-$month-31'");
$positions = $pdo->query("SELECT FOUND_ROWS()")->fetchColumn();


foreach ($pdo->query($sql) as $key => $row) {
print_r($row);
    
$name = $row['p_name'];
$quantity = $row['qty'];
$pieces = $lang_billing[$_SESSION['language']][8];
$singleprice = $row['p_price'];
$price = $row['qty']*$row['p_price'];
$key += 1;
$html .=
'<tr>
<th scope="row">'.$key.'</th>
<td style="text-align: center;">'.$name.'</td>
<td style="text-align: center;">'.$quantity.' '.$pieces.'</td>
<td style="text-align: center;">'.$singleprice.' &euro;</td>
<td style="text-align: center;">'.$price.' &euro;</td>
</tr>';


}
 

$html .="</table>";
 
 
 
$html .= '
<hr>
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">';

 
$html .='
            <tr>
                <td colspan="3"><b>Gesamtsumme Bestellungen: </b></td>
                <td style="text-align: center;"><b>'.$_POST['total'].' Euro</b></td>
            </tr>
            <tr>
                <td colspan="3"><b>Grundgehalt: </b></td>
                <td style="text-align: center;"><b>'.$_POST['basicpay'].' Euro</b></td>
            </tr>
            <tr>
                <td colspan="3"><b>Bonus: </b></td>
                <td style="text-align: center;"><b>'.$_POST['bonus'].' Euro</b></td>
            </tr>
            <tr>
                <td colspan="3"><b>Gesamtgehalt: </b></td>
                <td style="text-align: center;"><b>'.$_POST['pay'].' Euro</b></td>
            </tr> 
        </table>
<br><br><br>';
 

//Kreisdiagramm

// Anteilige Prozentwerte je Eingabewert --
// alle Werte ergeben 100 Prozent ---------
$alle = $_POST['pay'];

// Prozentanteil für Regen ----------------
$prozent_wert1 = $_POST['bonus'] * 100 / $alle;
// Prozentanteil für Sonne ----------------
$prozent_wert2 = $_POST['basicpay'] * 100 / $alle;

// Grundsätzliche Grafikgröße deklarieren ---
$flaeche = imagecreate (980,350);
// Hintergrundfarbe -------------------------
$hintergrund = imagecolorallocate($flaeche,255,255,255);

// Textfarbe --------------------------------
$schriftfarbe = imagecolorallocate($flaeche,0,0,0);
// Textkonstante ----------------------------
$text = 'Legende';
// Text auf Grafik einbinden ----------------
imagestring($flaeche,15,580,40,$text,$schriftfarbe);

// Legende 1 *******************************
// Farbfestlegung --------------------------
$gruen = imagecolorallocate($flaeche,0,255,0);

// Platzierung und Farbintegration ---------
// hier Rechteckfunktion genutzt -----------
imagefilledrectangle($flaeche,580,140,600,120,$gruen);

// Legendentext ----------------------------
imagestring($flaeche,15,620,80,"Grundgehalt",$schriftfarbe);

// Legende 2 *******************************
$rot = imagecolorallocate($flaeche,255,0,0);
imagefilledrectangle($flaeche,580,80,600,100,$rot);
imagestring($flaeche,15,620,120,"Bonus",$schriftfarbe);

// Kreisdiagramm ***************************
// Gradanteil je Kreissegment --------------
$grad_je_prozent = 360 / 100;
// Kreissegment 1 **************************
// Ende des ersten Kreissegments (Gradanzahl)
$ende_kreissegment_1 = $grad_je_prozent * $prozent_wert1;

// Farbzuweisung 1. Kreissegment -----------
$gruen = imagecolorallocate($flaeche,0,255,0);

// Kreissegment 1 Mittelpunkt, Durchmesser,-
// Startposition, Endposition, ----
// Farbzuweisung ---------------------------
// Funktion imagefilledarc() ---------------
imagefilledarc($flaeche,250, 175,350, 350, 0,$ende_kreissegment_1,$gruen, IMG_ARC_PIE);

// Kreissegment 2 **************************
$anfang_kreissegment_2 = $grad_je_prozent * $prozent_wert1;
$ende_kreissegment_2 = $grad_je_prozent * ($prozent_wert1 + $prozent_wert2);
$rot = imagecolorallocate ($flaeche,255,0,0);
imagefilledarc($flaeche, 250, 175, 350, 350,
$anfang_kreissegment_2,
$ende_kreissegment_2,
$rot, IMG_ARC_PIE);

imagepng ($flaeche, "diagramm.png");
imagedestroy($flaeche);
echo "<img src='diagramm.png'>";

$html .= nl2br($rechnungs_footer);
 
 
 
//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
// TCPDF Library laden
require_once('../../tcpdf/tcpdf.php');
 
// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Rechnung '.$rechnungs_nummer);
$pdf->SetSubject('Rechnung '.$rechnungs_nummer);
 
 
// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// Schriftart
$pdf->SetFont('dejavusans', '', 10);
 
// Neue Seite
$pdf->AddPage();
 
// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');

// ADD AN IMAGE
$img = "diagramm.png";
// I HAVE NO IDEA WHAT THIS IS DOING TO IMAGE SCALE - EXPERIMENT WITH IT
$pdf->setImageScale(2);

// GET THE IMAGE SETTINGS
$pdf->Image
( $img
, 0               // $x
, 200               // $y
, 0               // WIDTH
, 0               // HEIGHT
, 'PNG'           // TYPE
, '#'             // LINK URL
, 'T'             // SET POINTER TOP LEFT
, TRUE            // NO RESIZING
, 300             // DPI
, 'R'             // PALIGN
, FALSE           // ISMASK
, FALSE           // IMGMASK
, 0               // BORDER
, FALSE           // FIT TO BOX
, FALSE           // HIDDEN
, FALSE           // FIT ON PAGE
);
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
/* $pdf->Output($pdfName, 'I'); */
/* $pdf_file_link = "pdf".DIRECTORY_SEPARATOR."payrolls".DIRECTORY_SEPARATOR.$pdf_name.".pdf";
$pdf_file_name = realpath('./../..').DIRECTORY_SEPARATOR.$pdf_file_link; */
//Variante 2: PDF im Verzeichnis abspeichern:
$pdf->Output/* (dirname(__FILE__). */(realpath('./../..').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName, 'F');
echo "PDF herunterladen: <a href=\"../../pdf".DIRECTORY_SEPARATOR.$pdfName."\">".$pdfName."</a>";

?>