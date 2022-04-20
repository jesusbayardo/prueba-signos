<?php

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

class imprimirFactura
{

    public $codigo;

    public function traerImpresionFactura()
    {

        //TRAEMOS LA INFORMACIÓN DE LA VENTA

        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];

        $respuest = ControladorVentas::ctrRangoFechasComprasProveedor($fechaInicial, $fechaFinal);

        //REQUERIMOS LA CLASE TCPDF

        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();

        $pdf->AddPage();






        // ---------------------------------------------------------

        $bloque1 = <<<EOF

	<table>
		
		<tr>
        <br><br>
			<td style="width:120px"><img src="images/img.png"></td>

			<td style="background-color:white; width:280px">
				
				<div style="font-size:15.5px; text-align:center; line-height:15px;">
					
						REPORTE PRODUCTOS POR PROVEEDORES

					

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
        <td style="border: 1px solid #666; background-color:white; width:35px;font-weight: bold; text-align:center">#</td>
		<td style="border: 1px solid #666; background-color:white; width:100px;font-weight: bold; text-align:center">Cód. compra</td>
		<td style="border: 1px solid #666; background-color:white; width:100px;font-weight: bold; text-align:center">Proveedor</td>
		<td style="border: 1px solid #666; background-color:white; width:165px;font-weight: bold; text-align:center">Descripción producto</td>
        <td style="border: 1px solid #666; background-color:white; width:75px;font-weight: bold; text-align:center">Precio compra</td>
		<td style="border: 1px solid #666; background-color:white; width:75px;font-weight: bold; text-align:center">Fecha ingreso</td>
	

		</tr>

	</table>

EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------


        $sum = 0;

        foreach ($respuest as $key1 => $value1) {

            $id_proovedor = $value1["id_proveedor"];
            $Factura = $value1["codigo"];
            $fecha = $value1["fecha"];
            $listaProducto = json_decode($value1["productos"], true);
            $itemCliente = "id";
            $valorCliente = $value1["id_proveedor"];
            foreach ($listaProducto as $key2 => $value2) {
               
                $respuestaCliente = ControladorProveedores::ctrMostrarProvedores($itemCliente, $valorCliente);
               $precio= number_format($value2["precio"], 2);
                
                if ($_GET["qieybavcs"] == "" && $_GET["qieybrerwavcs"] == "") {
                    $sum = $sum + 1;
                    $bloque4 = <<<EOF
                    <table style="font-size:8px; padding:5px 10px;">
        
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:35px; text-align:center"> 
                     $sum
                     </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; ">
                    $Factura
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:leff">
                    $respuestaCliente[empresa]
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:165px; text-align:center">
                    $value2[descripcion]
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $precio
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $fecha 
                    </td>
                
        
        
                </tr>
        
            </table>    
        
        
EOF;

                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                } else  if ($value2["id"] == $_GET["qieybrerwavcs"] && $_GET["qieybavcs"] == "") {
                    $sum = $sum + 1;
                    $bloque4 = <<<EOF
                    <table style="font-size:8px; padding:5px 10px;">
        
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:35px; text-align:center"> 
                     $sum
                     </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; ">
                    $Factura
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:leff">
                    $respuestaCliente[empresa]
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:165px; text-align:center">
                    $value2[descripcion]
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $precio
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $fecha 
                    </td>
                
        
        
                </tr>
        
            </table>    
        
        
EOF;

                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                } else  if ($respuestaCliente["id"] == $_GET["qieybavcs"] && $_GET["qieybrerwavcs"] == "") {
                    $sum = $sum + 1;
                    $bloque4 = <<<EOF
                    <table style="font-size:8px; padding:5px 10px;">
        
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:35px; text-align:center"> 
                     $sum
                     </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; ">
                    $Factura
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:leff">
                    $respuestaCliente[empresa]
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:165px; text-align:center">
                    $value2[descripcion]
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $precio
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $fecha 
                    </td>
                
        
        
                </tr>
        
            </table>    
        
        
EOF;

                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                } else  if ($respuestaCliente["id"] == $_GET["qieybavcs"] && $value2["id"] == $_GET["qieybrerwavcs"]) {
                    $sum = $sum + 1;
                    $bloque4 = <<<EOF
                    <table style="font-size:8px; padding:5px 10px;">
        
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:35px; text-align:center"> 
                     $sum
                     </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; ">
                    $Factura
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:leff">
                    $respuestaCliente[empresa]
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:165px; text-align:center">
                    $value2[descripcion]
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $precio
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $fecha 
                    </td>
                
        
        
                </tr>
        
            </table>    
        
        
EOF;

                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
            }
        }

        // ---------------------------------------------------------


        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        //$pdf->Output('factura.pdf', 'D');
        $pdf->Output('factura.pdf');
    }
}

$factura = new imprimirFactura();

$factura->traerImpresionFactura();
