<?php
App::import('Vendor','xtcpdf');
ob_end_clean(); 
$tcpdf = new XTCPDF();

$tcpdf->SetAuthor("USJInscription");
$tcpdf->SetAutoPageBreak( false );
$resolution= array(95, 210);
$tcpdf->AddPage('L', $resolution);
$logo='<img src="img/header.jpg"/>';
$tcpdf->writeHTMLCell($w='', $h='', $x='', $y='5', $logo, $border=0, $ln=1, $fill=0, $reseth=true);

$annee='<h5> Ann&eacute;e 2013/2014</h5>';
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='12', $annee, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='18', 'Dossier '.$dossierid, $border=0, $ln=1, $fill=0, $reseth=true);

$tcpdf->SetFont(PDF_FONT_MONOSPACED,'','8');
$tcpdf->setCellHeightRatio(2);
$html = <<<EOD
</center><table  bordercolor="#0053b0" color="#0053b0" border="0.3" >
  <tr align="center">
    <td rowspan="2" colspan="2">Institut/Cursus</td>
    <td colspan="2">Droits de scolarit&eacute;</td>
    <td colspan="2">Montant</td>
    <td colspan="2">Delai de paiement</td>
  </tr>
  <tr align="center">
    <td>Semestre</td>
    <td>Versement</td>
    <td></td>
    <td></td>
    <td>du</td>
    <td>au</td>
  </tr>
  <tr  align="center">
    <td colspan="2">USJ</td>
    <td></td>
    <td></td>
    <td>150 000L.L.</td>
    <td></td>
    <td>1/3/2014</td>
    <td> 1/2/2015</td>
  </tr>
  
 </table>
EOD;
$tcpdf->writeHTMLCell($w='170', $h='', $x='20', $y='40', $html, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->SetFont(PDF_FONT_NAME_DATA,'','8');
$footer='<div  align="center" bgcolor="#e4edf4" ><font color="#0053ad">Rectorat de l\'USJ, Rue de Damas, B.P. 17-5208, Mar Mikha&euml;l 1104 2020 Beyrouth, Liban. T&eacute;l : 961.1.421000, Tpie : 961.1.421112</font></div>';
//$tcpdf->WriteHTML($footer);	
$tcpdf->writeHTMLCell($w='170', $h='20', $x='20', $y='80', $footer, $border=0, $ln=1, $fill=0, $reseth=true);

if(isset($username) && isset($password))
{
$tcpdf->AddPage('L', $resolution);

$logo='<img src="img/header.jpg"/>';
$tcpdf->writeHTMLCell($w='', $h='', $x='', $y='5', $logo, $border=0, $ln=1, $fill=0, $reseth=true);

$annee='<h5> Ann&eacute;e 2013/2014</h5>';
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='12', $annee, $border=0, $ln=1, $fill=0, $reseth=true);
$username="Username : ".$username;
$password ="Mdt de passe : ".$password;
$message="Un compte est cr&eacute;e avec les param&egrave;tres suivantes :";
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='32', $message, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='42', $username, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='52', $password, $border=0, $ln=1, $fill=0, $reseth=true);
}

echo $tcpdf->Output($filename, $option);

?>