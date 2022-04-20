<?php


require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";


require_once "../../../controladores/unidades.controlador.php";
require_once "../../../modelos/unidades.modelo.php";


require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

	
	// Page footer
	public function Footer()
	{
        $valorCompra = $_GET["codigo"];
		$valorVenta = "id";
		$respuestaCompra = ControladorCompras::ctrMostrarCompras($valorVenta, $valorCompra);
		$neto = number_format($respuestaCompra["neto"], 2);
		$impuesto = number_format(($respuestaCompra["neto"] * 12) / 100, 2);
		$total = number_format($respuestaCompra["total"], 2);
		
		// Position at 15 mm from bottom
		$this->SetY(-50);
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
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:67px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			 ' . 	$neto . '
			</td>
		</tr>
	
		<tr>
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666;  background-color:white; width:67px; text-align:center">
			Iva 0%:
		</td>

		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			0.00
		</td>
	</tr>


		<tr>
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:67px; text-align:center">
		Iva 12%:
		</td>
	
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				' . $impuesto . '
			</td>
		</tr>

		
		<tr>
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:67px; text-align:center">
			Total:
		</td>
		
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
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
		$valorVenta = "id";
		$valorCompra = $this->codigo;
		$respuestaCompra = ControladorCompras::ctrMostrarCompras($valorVenta, $valorCompra);
		$numeroCompra=$respuestaCompra["codigo"];
		$fecha = substr($respuestaCompra["fecha"], 0, -8);		
		$productos = json_decode($respuestaCompra["productos"], true);
		
		//TRAEMOS LA INFORMACIÓN DEL CLIENTE
		$itemProveedore = "id";
		$valorProveedor= $respuestaCompra["id_proveedor"];
		$nombres="";
		$direccion="";
		$documento="";
		$telefono="";
		$Empresa="";
		$email="";
		$respuestaCliente = ControladorProveedores::ctrMostrarProvedores($itemProveedore, $valorProveedor);


		if($respuestaCliente==false){
			$nombres="Proveedor Elimindado";
			$direccion="Proveedor Elimindado";
			$documento="Proveedor Elimindado";
			$telefono="N/A";
			$Empresa="N/A";
			$email="N/A";
		}else{
			$nombres=$respuestaCliente["nombre"];
			$direccion=$respuestaCliente["direccion"];
			$documento=$respuestaCliente["documento"];
			$telefono=$respuestaCliente["telefono"];
			$Empresa=$respuestaCliente["empresa"];
			$email=$respuestaCliente["email"];
		}

		//REQUERIMOS LA CLASE TCPDF
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		// set header and footer fonts
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins(1, 1, 0);
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
			
			<td style="width:150px">$Empresa</td>

			<td style="background-color:white; width:110px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">				
					<br>
					Dirección: $direccion
				</div>
			</td>

			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Teléfono: $telefono
					<br>
					$email
				</div>
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$numeroCompra</td>
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
			<td style="bordercolor:black; background-color:white; width:5px;">			
			</td>
			<td style="bordercolor:black; background-color:white; width:600px;">
			Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="bordercolor:black; background-color:white; width:5px;">			
			</td>
			<td style="bordercolor:black; background-color:white; width:342px;">
			Nombres: $nombres
			</td>

			<td style="bordercolor:black; background-color:white; width:200px;">
			Cedula/RUC: $documento
			</td>
		</tr>

		<tr>
		
	</table>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF
		

		<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:300px; text-align:center">Detalle Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------

		foreach ($productos as $key => $item) {

			$idProducto = $item["id"];
			
			$item1 = "id";
			$productos = ControladorProductos::ctrMostrarProducto($item1, $idProducto);
			
			
			$valorUnitario = number_format($item["precio"], 2);

			$precioTotal = number_format($item["total"], 2);

			$bloque4 = <<<EOF

			<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:60px: text-align:center">
		$item[cantidad]
			</td>
				
			<td style="border: 1px solid #666; background-color:white; width:300px: text-align:center">
			$item[descripcion]
			</td>

			<td style="border: 1px solid #666; background-color:white; width:80px: text-align:center">
	$valorUnitario
			</td>
			<td style="border: 1px solid #666; background-color:white; width:70px: text-align:center">

				$precioTotal
			</td>


		</tr>

	</table>


EOF;

			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}

		// ---------------------------------------------------------




       

        ob_end_clean();

		$pdf->Output($valorCompra, 'I');
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