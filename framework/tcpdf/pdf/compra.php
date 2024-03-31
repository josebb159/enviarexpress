<?php
include '../../../model/estadoactual.php';

$codigo = $_GET['codigo'];
$n_estado_acual  = new estadoactual();
$resultado = $n_estado_acual -> buscar_estadoactual_codigo($codigo);
$datos ="";
$cont = 0;
foreach ($resultado as $key) {
if($cont==0){
	$codigo = $key['codigo']; 
	$fecha = $key['fech']; 
	$fabricante = $key['fabricante'];  
	$n_orden = $key['n_orden'];
	$cont++;
}	
$numeroConCeros = str_pad($n_orden, 6, "0", STR_PAD_LEFT);

$datos = $datos ."<tr>

	<td>".$key['producto']."-".$key['ref']."<br></td>
	<td>Exento (compras)</td>
	<td>".$key['fech']."</td>
	<td>".$key['cantidad']."</td>
	<td>0</td>
	<td>0</td>

	
	</tr>
	";


}


/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);






// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,0,0), array(0,0,0));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD







<h2>Confirmación pedido de compra #P$numeroConCeros</h2>
<h3>Fabricante: $fabricante </h3>


<table >
<tr class=" border: none;">
	<td style=" border-right: solid 0px white; border-left: solid 0px white;"><b>Ref. de nuestra orden:</b><br></td>
	<td style=" border-right: solid 0px white; border-left: solid 0px white;"><b>Su referencia de pedido:</b><br></td>
	<td style=" border-right: solid 0px white; border-left: solid 0px white;"><b>Fecha de orden:</b><br></td>

</tr>
<tr>
	<td style=" border-right: solid 0px white; border-left: solid 0px white;">P$numeroConCeros</td>
	<td style=" border-right: solid 0px white; border-left: solid 0px white;"><b>$codigo</b></td>
	<td style=" border-right: solid 0px white; border-left: solid 0px white;">$fecha</td>
</tr>
</table>

<br>
<h2 style="text-align: center;">LISTADO DE COMPRA</h2>
<br>

<style>table { border-collapse: collapse; }
tr { border: none; }
td {
  border-right: solid 1px black; 
  border-left: solid 1px black;
  vertical-align:middle;
}</style>

<table id="datatable-buttons" border="1"  style="text-align: center; border-collapse: collapse; border-spacing: 0; width: 100%;">
<thead>
	<tr style="text-align:center;">
		<th><b>Descripcion</b></th>
		<th><b>Impuesto</b></th>
		<th><b>Fecha REQ</b></th>
		<th><b>Cantidad</b></th>
		<th><b>Precio</b></th>
		<th><b>Importe</b></th>
	
	</tr>
</thead>


<tbody id="datos">
$datos 

</tbody>
</table>

<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table border="1" style="width:200px: float: left;">
<tr>
<td><b>Subtotal</b></td>
<td>$0.00</td>
</tr>
<tr>
<td><b>Impuetos</b></td>
<td>$0.00</td>
</tr>
<tr>
<td><b>Total</b></td>
<td>$0.00</td>
</tr>
</table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
