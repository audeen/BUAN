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

$pdo;
print_r($_POST);
$retailer = $_POST['retailer'];
$year = $_POST['year'];
$month = $_POST['month'];



//https://www.php-einfach.de/experte/php-codebeispiele/pdf-per-php-erstellen-pdf-rechnung/


$rechnungs_nummer = "DUMMY";
$rechnungs_datum = date("d.m.Y");
$lieferdatum = date("d.m.Y");
$pdfAuthor = "BUAN";
 
$rechnungs_header = '
<img src="logo.png">
BUAN
Jannik Sievert';
 
$rechnungs_empfaenger = 'Max Musterman
Musterstraße 17
12345 Musterstadt';
 
$rechnungs_footer = "Wir bitten um eine Begleichung der Rechnung innerhalb von 14 Tagen nach Erhalt. Bitte Überweisen Sie den vollständigen Betrag an:
 
<b>Empfänger:</b> Meine Firma
<b>IBAN</b>: DE85 745165 45214 12364
<b>BIC</b>: C46X453AD";
 
//Auflistung eurer verschiedenen Posten im Format [Produktbezeichnung, Menge, Einzelpreis]

$sql =   ("SELECT * FROM products, retailer, orders 
WHERE id_r $retailer
AND r_id = id_r
AND id_p = p_id
AND order_date BETWEEN '$year-$month-01' AND '$year-$month-31'");
print_r($sql);
foreach ($pdo->query($sql) as $row) {
echo "<tr>";
echo "<th scope=\"row\">DUMMY</th>";
echo "<td>".$row['p_name']."</td>";
echo "<td>".$row['qty']." ".$lang_billing[$_SESSION['language']][8]."</td>";
echo "<td>".$row['p_price']." &euro;</td>";
echo "<td>".$row['qty']*$row['p_price']." &euro;</td>";
echo "</tr>";
}

 
//Höhe eurer Umsatzsteuer. 0.19 für 19% Umsatzsteuer
$umsatzsteuer = 0.0; 
 
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
Lieferdatum: '.$lieferdatum.'<br>
 </td>
 </tr>
 
 <tr>
 <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Rechnung
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
 <td style="padding:5px;"><b>Bezeichnung</b></td>
 <td style="text-align: center;"><b>Menge</b></td>
 <td style="text-align: center;"><b>Einzelpreis</b></td>
 <td style="text-align: center;"><b>Preis</b></td>
 </tr>';
 
 
$gesamtpreis = 0;

$sql =   ("SELECT * FROM products, retailer, orders 
WHERE id_r $retailer
AND r_id = id_r
AND id_p = p_id
AND order_date BETWEEN '$year-$month-01' AND '$year-$month-31'");

foreach ($pdo->query($sql) as $row) {
$name = $row['p_name'];
$quantity = $row['qty'];
$pieces = $lang_billing[$_SESSION['language']][8];
$singleprice = $row['p_price'];
$price = $row['qty']*$row['p_price'];

$html .=
'<tr>
<th scope="row">DUMMY</th>
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
 
if($umsatzsteuer == 0) {
 $html .= 'Nach § 19 Abs. 1 UStG wird keine Umsatzsteuer berechnet.<br><br>';
}
 
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
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
/* $pdf->Output($pdfName, 'I'); */
 
//Variante 2: PDF im Verzeichnis abspeichern:
$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';

?>