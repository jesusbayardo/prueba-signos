<?php



require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";




require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{


	// Page footer
	public function Footer()
	{

		$valorVenta = $_GET["codigo"];
		$itemVenta = "codigo";
		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);



		$neto = number_format($respuestaVenta["total"], 2);
		$impuesto = number_format($respuestaVenta["iva"], 2);
		$total = number_format($respuestaVenta["total_pagar"], 2);



		// Position at 15 mm from bottom
		$this->SetY(-46);
		$this->SetX(0);
		// Set font
		$this->SetFont('helvetica', '', 8);
		// Custom footer HTML
		$this->html = '
	
		<table style="font-size:10px; padding:8px 10px;">

		<tr>

			<td style="border: hidden"></td>
			<td style="border: hidden"></td>
			<td style="border: hidden"></td>

		</tr>
		
		<tr>
		
			<td style="border: 1px  white;  background-color:white; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px  white;  background-color:white; width:100px; text-align:center">
			</td>
			<td style="border: 1px  white;  background-color:white;background-color:white; width:100px; text-align:center">
				 ' . 	$neto . '
			</td>

		</tr>
	


		<tr>
		<td style="border: 1px  white; color:#333; background-color:white; width:340px; text-align:center"></td>
		<td style="border: 1px  white;  background-color:white; width:100px; text-align:center">
		</td>

		<td style="border: 1px  white; color:#333; background-color:white; width:100px; text-align:center">
			0.00
		</td>

	</tr>


		<tr>

			<td style="border: 1px  white;  background-color:white; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px  white; background-color:white; width:100px; text-align:center">
			</td>
			<td style="border: 1px  white;color:#333; background-color:white; width:100px; text-align:center">
				' . $impuesto . '
			</td>
		</tr>

		

		<tr>
			<td style="border: 1px  white; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px  white; background-color:white; width:100px; text-align:center">
			</td>
			<td style="border: 1px  white; color:#333; background-color:white; width:100px; text-align:center">
				' . $total . '
			</td>
		</tr>






	</table>';
		$this->writeHTML($this->html, true, false, true, false, '');
	}
}

// create new PDF document



class imprimirFactura
{

	public $codigo;
	public function traerImpresionFactura()
	{
		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		$itemVenta = "codigo";
		$valorVenta = $this->codigo;

		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);
		$descuento = $respuestaVenta["descuento"];

		$fecha = substr($respuestaVenta["fecha"], 0, -8);

		$productos = json_decode($respuestaVenta["productos"], true);



		//TRAEMOS LA INFORMACIÓN DEL CLIENTE

		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];
		$nombres = "";
		$direccion = "";
		$documento = "";
		$telefono = "";

		$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
		if ($respuestaCliente == false) {
			$nombres = "CLIENTE ELIMINADO";
			$direccion = "CLIENTE ELIMINADO";
			$documento = "CLIENTE ELIMINADO";
			$telefono = "N/A";
		} else {

			$nombres = $respuestaCliente["nombre"];
			$direccion = $respuestaCliente["direccion"];
			$documento = $respuestaCliente["documento"];
			$telefono = $respuestaCliente["telefono"];
		}





		//REQUERIMOS LA CLASE TCPDF
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->setPrintHeader(false);
		// set header and footer fonts

		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(3, 8, 0);

		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('times', 'BI', 10);

		// add a page

		$pdf->AddPage('P', 'A5');
		$bloque1 = <<<EOF

	<table>
		<tr>
			<td style="width:150px">  </td>

		
			<td style="background-color:white; width:215px">
				<div style="font-size:8.5px; text-align:center; line-height:15px;">
				<div style="font-size:11px;font-weight: bold;">	</div>
				<br>
				</div>
				
			</td>

			<td style="background-color:white; width:190px">
			<div style="font-size:8.5px; text-align:center; line-height:15px;">
			<div style="font-weight: bold;">  </div> 
			<label style="color: white;font-size:12px "></label>
			<br>
			<br>
			
			</div>
			</td>
		</tr>
	</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:9px; padding:7px 10px;background-color:white">
	


		<tr>
			<td style="bordercolor:black; background-color:white; width:70px;">			
			</td>
			<td style="bordercolor:black; background-color:white; width:600px;">
			$fecha
			</td>
		</tr>
		<tr>
			<td style="bordercolor:black; background-color:white; width:70px;">			
			</td>
			<td style="bordercolor:black; background-color:white; width:339px;">
			$nombres
			</td>


			<td style="bordercolor:black; background-color:white; width:200px;">
			$documento
			</td>
		</tr>



		<tr>
		<td style="bordercolor:black; background-color:white; width:70px;">			
		</td>
			<td style="bordercolor:black; background-color:white; width:339px;">
			 $direccion
			</td>

			<td style="bordercolor:black; background-color:white; width:200px;">
			 $telefono
			</td>
		</tr>

		

		

	</table>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF
		

	<table style="font-size:11px; padding:6px 10px;">

		<tr>
		<td style="border: 1px  white; background-color:white; width:80px; text-align:center"></td>
		<td style="border: 1px  white; background-color:white; width:365px; text-align:center"></td>
		
		<td style="border: 1px  white; background-color:white; width:100px; text-align:center"> </td>
		<td style="border: 1px  white; background-color:white; width:100px; text-align:center"> </td>

		</tr>

	</table>


EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------

		foreach ($productos as $key => $item) {
			
		

		
			

			$valorUnitario = number_format($item["precio"], 2);

			$precioTotal = number_format($item["total"], 2);
			$descripcion = $item["descripcion"];

			$contador = strlen($descripcion);

			if ($contador > 51) {
			$detalleproducto=	substr($descripcion, 0, 51);
			}else{
				$detalleproducto=$descripcion;
				
			}

			$bloque4 = <<<EOF

		
			
	<table style="font-size:10px; padding:5px 0px;">

		<tr>
			<td style="border: 1px  white; color:#333; background-color:white; width:70px; text-align:center">
				$item[cantidad]
			</td>
			<td style="border: 1px  white; color:#333; background-color:white; width:291px; ">
			$detalleproducto
			</td>

			

			<td style="border: 1px  white; color:#333; background-color:white; width:80px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px  white; color:#333; background-color:white; width:70px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}

		// ---------------------------------------------------------





		$pdf->Output($valorVenta, 'I');
	}
}










// ---------------------------------------------------------

//Close and output PDF document

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();

//============================================================+
// END OF FILE
//============================================================+