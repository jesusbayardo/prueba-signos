<?php
session_start();
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


include_once "../../../controladores/bodega.controlador.php";
include_once "../../../modelos/bodega.modelo.php";



include_once "../../../controladores/unidades.controlador.php";
include_once "../../../modelos/unidades.modelo.php";

class imprimirFactura
{

	public $codigo;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA
		$valor = $_SESSION["bodega"];
		$item = "id";


		$bodega = Controladorbodegas::ctrMostrarBodega($item, $valor);

		$nombreBodega = $bodega["nombre_bodega"];

		$productos = ControladorProductos::ctrMostrarProductos();
		//REQUERIMOS LA CLASE TCPDF
		require_once('tcpdf_include.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->startPageGroup();
		$pdf->AddPage();
		$pdf->SetMargins(1, 1, 0);
		// ---------------------------------------------------------

		$bloque1 = <<<EOF
	<table>
		<tr>
        <br><br>
			<td style="width:120px"><img src="images/img.png"></td>

			<td style="background-color:white; width:280px">
				
				<div style="font-size:15.5px; text-align:center; line-height:15px;">
					
						INVENTARIO DE PRODUCTOS $nombreBodega
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
EOF;
		$pdf->writeHTML($bloque2, false, false, false, false, '');
		// ---------------------------------------------------------

		$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>
        <td style="border: 1px solid #666; background-color:white; width:80px;font-weight: bold; text-align:center">Código</td>
		<td style="border: 1px solid #666; background-color:white; width:180px;font-weight: bold; text-align:center">Detalle producto</td>
		<td style="border: 1px solid #666; background-color:white; width:100px;font-weight: bold; text-align:center">Presentación</td>
		<td style="border: 1px solid #666; background-color:white; width:50px;font-weight: bold; text-align:center">Stock</td>
		<td style="border: 1px solid #666; background-color:white; width:60px;font-weight: bold; text-align:center">$ Minorista</td>
		<td style="border: 1px solid #666; background-color:white; width:60px;font-weight: bold; text-align:center">$ Mayorista</td>		
		<td style="border: 1px solid #666; background-color:white; width:60px;font-weight: bold; text-align:center">$ Crédito</td>
		
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		$stock=0;
		$precioMenor =0;
				$precioMayor =0;
				$precioCredito=0;
		foreach ($productos as $key => $item) {


			$tablaBodega = "asignacion_bodega";
			$idBodega = $_SESSION["bodega"];
			$id_producto = $item["id"];

			$traerProducto = Modelobodegas::mdlMostrarDatosAsignacion($tablaBodega, $id_producto, $idBodega);
			$stockProductos = $traerProducto["stock"];
			$estado = $traerProducto["estado"];



			$idUnidad=$item["id_unidad"];

			$unidad=ControladorUnidades::ctrMostrarUnidad("id", $idUnidad);
			$descripcionUnidad= $unidad["nombre_unidad"];




			if ($estado == 1) {
				if ($stockProductos <= 10) {
					$stock =  $stockProductos ;
				} else if ($stockProductos > 11 && $stockProductos <= 15) {
					$stock =  $stockProductos;
				} else {
					$stock =  $stockProductos ;
				}

				$precioMenorPorcentaje = ($item["precio_venta"] * $item["precio_menor"]) / 100;
				$precioMayorPorcentaje = ($item["precio_venta"] * $item["precio_mayor"]) / 100;
				$precioCreditoPorcentaje = ($item["precio_venta"] * $item["precio_credito"]) / 100;

				$precioMenor = number_format($item["precio_venta"] + $precioMenorPorcentaje, 2);
				$precioMayor = number_format($item["precio_venta"] + $precioMayorPorcentaje, 2);
				$precioCredito = number_format($item["precio_venta"] + $precioCreditoPorcentaje, 2);
			}

			$bloque4 = <<<EOF

			
			<table style="font-size:7px; padding:5px 10px;">

			<tr>
        		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:left"> 
        		$item[codigo]
       		 </td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:180px; ">
           		 $item[descripcion]
			</td>


			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; ">
			$descripcionUnidad
			</td>


			<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
			$stock
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
			$precioMenor
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
			$precioMayor
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
           $precioCredito
			</td>


			
	
		</tr>

	</table>


			
EOF;

			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		$pdf->Output('inventario.pdf');
	}
}

$factura = new imprimirFactura();

$factura->traerImpresionFactura();
